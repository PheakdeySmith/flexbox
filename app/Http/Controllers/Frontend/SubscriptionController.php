<?php

namespace App\Http\Controllers\Frontend;

use App\Events\SubscriptionCanceled;
use App\Events\SubscriptionCreated;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Services\SubscriptionRoleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * The subscription role service instance.
     *
     * @var SubscriptionRoleService
     */
    protected $subscriptionRoleService;

    /**
     * Create a new controller instance.
     *
     * @param SubscriptionRoleService $subscriptionRoleService
     * @return void
     */
    public function __construct(SubscriptionRoleService $subscriptionRoleService)
    {
        $this->subscriptionRoleService = $subscriptionRoleService;
    }

    /**
     * Display a listing of subscription plans.
     */
    public function index()
    {
        $plans = SubscriptionPlan::active()->get();
        return view('frontend.subscription.index', compact('plans'));
    }

    /**
     * Show the checkout page for a subscription plan.
     */
    public function checkout($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        // Check if user already has an active subscription
        $hasActiveSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->exists();

        return view('frontend.subscription.checkout', compact('plan', 'hasActiveSubscription'));
    }

    /**
     * Process the subscription.
     */
    public function subscribe(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        // Check if user already has an active subscription
        $hasActiveSubscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->exists();

        if ($hasActiveSubscription) {
            return redirect()->back()->with('error', 'You already have an active subscription.');
        }

        // Validate payment information
        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal',
            'agree_terms' => 'required|accepted',
        ]);

        // Start database transaction
        DB::beginTransaction();

        try {
            // Calculate dates
            $startDate = now();
            $trialEndsAt = null;

            // Check if this is a "forever" or very long-term plan
            $isLongTermPlan = $plan->duration_in_days > 3650; // More than 10 years

            if ($isLongTermPlan) {
                // For "forever" or very long-term plans, set end date to 10 years in the future
                // This prevents MySQL datetime errors while still providing a very long subscription
                $endDate = $startDate->copy()->addYears(10);
            } else if ($plan->has_trial && $plan->trial_days > 0) {
                $trialEndsAt = $startDate->copy()->addDays($plan->trial_days);
                $endDate = $startDate->copy()->addDays($plan->duration_in_days + $plan->trial_days);
            } else {
                $endDate = $startDate->copy()->addDays($plan->duration_in_days);
            }

            // Create subscription
            $subscription = Subscription::create([
                'user_id' => Auth::id(),
                'subscription_plan_id' => $plan->id,
                'status' => 'active',
                'start_date' => $startDate,
                'end_date' => $endDate,
                'trial_ends_at' => $trialEndsAt,
                'auto_renew' => true,
            ]);

            // Create payment records
            if ($plan->price > 0) {
                if ($plan->has_trial) {
                    // For trial plans, create a payment record with the full price
                    $payment = Payment::create([
                        'user_id' => Auth::id(),
                        'subscription_id' => $subscription->id,
                        'payment_method' => $request->payment_method,
                        'payment_type' => 'subscription',
                        'transaction_id' => 'SUB-' . uniqid(),
                        'amount' => $plan->price,
                        'currency' => 'USD',
                        'status' => 'completed',
                        'notes' => 'Subscription to ' . $plan->name . ' plan (Trial active until ' .
                                  $trialEndsAt->format('M d, Y') . ')',
                    ]);

                    // Log the created payment
                    \Log::info('Payment created', [
                        'payment_id' => $payment->id,
                        'status' => $payment->status,
                        'attributes' => $payment->getAttributes()
                    ]);

                    // Verify the payment was created with the correct status
                    if (!$payment->status) {
                        $payment->status = 'completed';
                        $payment->save();
                    }

                    // Create payment detail
                    PaymentDetail::create([
                        'payment_id' => $payment->id,
                        'payable_id' => $subscription->id,
                        'payable_type' => Subscription::class,
                    ]);
                } else {
                    // Regular paid subscription (no trial)
                    $payment = Payment::create([
                        'user_id' => Auth::id(),
                        'subscription_id' => $subscription->id,
                        'payment_method' => $request->payment_method,
                        'payment_type' => 'subscription',
                        'transaction_id' => 'SUB-' . uniqid(),
                        'amount' => $plan->price,
                        'currency' => 'USD',
                        'status' => 'completed',
                        'notes' => 'Subscription payment for ' . $plan->name,
                    ]);

                    // Log the created payment
                    \Log::info('Payment created', [
                        'payment_id' => $payment->id,
                        'status' => $payment->status,
                        'attributes' => $payment->getAttributes()
                    ]);

                    // Verify the payment was created with the correct status
                    if (!$payment->status) {
                        $payment->status = 'completed';
                        $payment->save();
                    }

                    // Create payment detail
                    PaymentDetail::create([
                        'payment_id' => $payment->id,
                        'payable_id' => $subscription->id,
                        'payable_type' => Subscription::class,
                    ]);
                }
            }

            // Dispatch subscription created event
            event(new SubscriptionCreated($subscription));

            // Update user role based on subscription status
            $this->subscriptionRoleService->updateUserRole(Auth::user());

            DB::commit();

            return redirect()->route('frontend.subscriptionDetail', $subscription->id)
                ->with('success', 'You have successfully subscribed to the ' . $plan->name . ' plan.');

        } catch (\Exception $e) {
            \Log::error('Payment creation error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to process subscription: ' . $e->getMessage());
        }
    }

    /**
     * Display subscription details.
     */
    public function subscriptionDetail($id)
    {
        $subscription = Subscription::with(['plan', 'payments'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.subscription.detail', compact('subscription'));
    }

    /**
     * Display subscription history.
     */
    public function history()
    {
        $subscriptions = Subscription::with('plan')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        $activeSubscription = Subscription::with('plan')
            ->where('user_id', Auth::id())
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->first();

        return view('frontend.subscription.history', compact('subscriptions', 'activeSubscription'));
    }

    /**
     * Cancel a subscription.
     */
    public function cancel(Request $request, $id)
    {
        $subscription = Subscription::where('user_id', Auth::id())->findOrFail($id);

        if ($subscription->status !== 'active') {
            return redirect()->back()->with('error', 'This subscription is already canceled or expired.');
        }

        $subscription->update([
            'status' => 'canceled',
            'canceled_at' => now(),
            'auto_renew' => false,
        ]);

        // Dispatch subscription canceled event
        event(new SubscriptionCanceled($subscription));

        // Update user role based on subscription status
        $this->subscriptionRoleService->updateUserRole(Auth::user());

        return redirect()->back()->with('success', 'Your subscription has been canceled.');
    }
}
