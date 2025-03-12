<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $query = Order::with(['user', 'items.movie']);

        if ($status) {
            $query->withStatus($status);
        }

        $orders = $query->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.movie', 'paymentDetail.payment']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        // Update the status of all order items
        $order->items()->update([
            'status' => $request->status,
        ]);

        // If there's a payment, update its status too
        if ($order->paymentDetail && $order->paymentDetail->payment) {
            $paymentStatus = $request->status === 'completed' ? 'completed' :
                            ($request->status === 'cancelled' ? 'refunded' : 'pending');

            $order->paymentDetail->payment->update([
                'status' => $paymentStatus,
            ]);
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Check if the order has a payment
        if ($order->paymentDetail && $order->paymentDetail->payment) {
            return redirect()->route('admin.orders.show', $order)
                ->with('error', 'Cannot delete an order with a payment. Cancel the order instead.');
        }

        $order->items()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
