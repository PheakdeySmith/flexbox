<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['user', 'subscription.subscriptionPlan'])->latest()->paginate(10);
        return view('backend.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $subscriptions = Subscription::with('subscriptionPlan')->where('status', 'active')->get();
        return view('backend.payment.create', compact('users', 'subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
            'status' => 'required|in:completed,pending,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $payment = Payment::create($request->all());

        return redirect()->route('payment.index')
            ->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load(['user', 'subscription.subscriptionPlan']);
        return view('backend.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $users = User::all();
        $subscriptions = Subscription::with('subscriptionPlan')->where('status', 'active')->get();
        return view('backend.payment.edit', compact('payment', 'users', 'subscriptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_id' => 'nullable|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'transaction_id' => 'nullable|string',
            'status' => 'required|in:completed,pending,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $payment->update($request->all());

        return redirect()->route('payment.index')
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payment.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Mark a payment as completed.
     */
    public function markAsCompleted(Payment $payment)
    {
        $payment->update(['status' => 'completed']);

        return redirect()->route('payment.show', $payment->id)
            ->with('success', 'Payment marked as completed.');
    }

    /**
     * Mark a payment as refunded.
     */
    public function markAsRefunded(Payment $payment)
    {
        $payment->update(['status' => 'refunded']);

        return redirect()->route('payment.show', $payment->id)
            ->with('success', 'Payment marked as refunded.');
    }
}
