<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $query = Order::with(['items.movie', 'paymentDetail.payment'])
            ->where('user_id', Auth::id());

        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->paginate(10);

        return view('frontend.orders.history', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $order->load(['items.movie', 'paymentDetail.payment']);
        return view('frontend.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // Ensure the user can only cancel their own orders
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if the order can be cancelled
        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        // Update order status
        $order->update(['status' => 'cancelled']);

        // Update order items status
        $order->items()->update(['status' => 'cancelled']);

        // If there's a pending payment, update its status
        if ($order->paymentDetail && $order->paymentDetail->payment) {
            $order->paymentDetail->payment->update(['status' => 'cancelled']);
        }

        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
    }
}
