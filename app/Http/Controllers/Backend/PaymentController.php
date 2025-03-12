<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaymentController extends Controller
{
    /**
     * Display a listing of the payments.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $type = $request->input('type');
        $query = Payment::with(['user', 'detail.payable']);

        if ($status) {
            $query->withStatus($status);
        }

        // Check if payment_type column exists
        $hasPaymentTypeColumn = Schema::hasColumn('payments', 'payment_type');

        if ($type && $hasPaymentTypeColumn) {
            if ($type === 'subscription') {
                $query->subscriptions();
            } elseif ($type === 'movie_purchase') {
                $query->moviePurchases();
            }
        } elseif ($type) {
            // Fallback if payment_type column doesn't exist
            if ($type === 'subscription') {
                $query->whereNotNull('subscription_id');
            } elseif ($type === 'movie_purchase') {
                $query->whereNull('subscription_id');
            }
        }

        $payments = $query->latest()->paginate(10);

        return view('backend.payments.index', compact('payments'));
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'detail.payable']);

        return view('backend.payments.show', compact('payment'));
    }

    /**
     * Update the status of the specified payment.
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        DB::beginTransaction();

        try {
            $payment->update([
                'status' => $request->status,
            ]);

            // Update the related entity status
            if ($payment->detail && $payment->detail->payable) {
                $payable = $payment->detail->payable;

                if ($payable instanceof \App\Models\Order) {
                    $orderStatus = $request->status === 'completed' ? 'completed' :
                                  ($request->status === 'refunded' ? 'cancelled' : 'pending');

                    $payable->update([
                        'status' => $orderStatus,
                    ]);

                    // Update order items status
                    $payable->items()->update([
                        'status' => $orderStatus,
                    ]);
                } elseif ($payable instanceof \App\Models\Subscription) {
                    $subscriptionStatus = $request->status === 'completed' ? 'active' :
                                         ($request->status === 'refunded' ? 'canceled' : 'pending');

                    $payable->update([
                        'status' => $subscriptionStatus,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('payment.show', $payment)
                ->with('success', 'Payment status updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('payment.show', $payment)
                ->with('error', 'Failed to update payment status: ' . $e->getMessage());
        }
    }

    /**
     * Display a dashboard with payment statistics.
     */
    public function dashboard()
    {
        // Total revenue
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

        // Check if payment_type column exists
        $hasPaymentTypeColumn = Schema::hasColumn('payments', 'payment_type');

        // Subscription revenue
        if ($hasPaymentTypeColumn) {
            $subscriptionRevenue = Payment::subscriptions()
                ->where('status', 'completed')
                ->sum('amount');

            // Movie purchase revenue
            $moviePurchaseRevenue = Payment::moviePurchases()
                ->where('status', 'completed')
                ->sum('amount');
        } else {
            // Fallback if payment_type column doesn't exist
            $subscriptionRevenue = Payment::where('status', 'completed')
                ->whereNotNull('subscription_id')
                ->sum('amount');

            $moviePurchaseRevenue = Payment::where('status', 'completed')
                ->whereNull('subscription_id')
                ->sum('amount');
        }

        // Recent payments
        $recentPayments = Payment::with(['user', 'detail.payable'])
            ->latest()
            ->take(5)
            ->get();

        // Monthly revenue chart data
        $monthlyRevenue = Payment::where('status', 'completed')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->take(12)
            ->get();

        // Payment method distribution
        $paymentMethods = Payment::where('status', 'completed')
            ->select('payment_method', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_method')
            ->get();

        return view('backend.payments.dashboard', compact(
            'totalRevenue',
            'subscriptionRevenue',
            'moviePurchaseRevenue',
            'recentPayments',
            'monthlyRevenue',
            'paymentMethods'
        ));
    }

    /**
     * Display payment history for a specific user.
     */
    public function userHistory(User $user)
    {
        $payments = Payment::with(['detail.payable'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('backend.payments.user-history', compact('user', 'payments'));
    }
}
