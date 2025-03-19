<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\Payment;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $status = $request->input('status');
        $query = Order::with(['user', 'items.movie']);

        if ($status) {
            $query->withStatus($status);
        }

        $orders = $query->latest()->paginate(10);

        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        $order->load(['user', 'items.movie', 'paymentDetail.payment']);

        return view('backend.orders.show', compact('order'));
    }

    /**
     * Update the status of the specified order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
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

        return redirect()->route('order.show', $order)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        if (!auth()->user()->hasRole('admin')) {
            return response()->view('frontend.404.index', [], 403);
        }
        // Check if the order has a payment
        if ($order->paymentDetail && $order->paymentDetail->payment) {
            return redirect()->route('order.show', $order)
                ->with('error', 'Cannot delete an order with a payment. Cancel the order instead.');
        }

        $order->items()->delete();
        $order->delete();

        return redirect()->route('order.index')
            ->with('success', 'Order deleted successfully.');
    }
}
