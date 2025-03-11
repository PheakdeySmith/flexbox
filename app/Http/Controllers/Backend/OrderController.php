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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $orders = OrderItem::with(['movie', 'user'])->latest()->get();
        $movies = Movie::active()->get();
        $users = User::all();

        return view('backend.order.index', compact('orders', 'movies', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        try {
            $movies = Movie::active()->get();
            $users = User::all();
            return view('backend.order.create', compact('movies', 'users'));
        } catch (\Exception $e) {
            Log::error('Failed to load create order form:', ['error' => $e->getMessage()]);
            return view('backend.order.create')->with('error', 'Failed to load data. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            // Validate input
            $validated = $request->validate([
                'movie_id' => 'required|exists:movies,id',
                'user_id' => 'required|exists:users,id',
                'price' => 'required|numeric|min:0',
                'status' => 'required|in:pending,completed,cancelled'
            ]);

            // Verify movie exists and get its details
            $movie = Movie::findOrFail($validated['movie_id']);

            // Create order
            $order = OrderItem::create([
                'movie_id' => $validated['movie_id'],
                'user_id' => $validated['user_id'],
                'price' => $validated['price'],
                'status' => $validated['status']
            ]);

            DB::commit();

            Log::info('Order created successfully:', ['order_id' => $order->id]);
            return redirect()
                ->route('order.index')
                ->with('success', 'Order created successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::warning('Order validation failed:', ['errors' => $e->errors()]);
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed:', [
                'error' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create order. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $order): View|RedirectResponse
    {
        try {
            $order->load(['movie' => function ($query) {
                $query->withTrashed();
            }, 'user']);
            return view('backend.order.show', compact('order'));
        } catch (\Exception $e) {
            Log::error('Failed to show order:', ['error' => $e->getMessage(), 'order_id' => $order->id]);
            return redirect()
                ->route('order.index')
                ->with('error', 'Failed to load order details.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $order): View|RedirectResponse
    {
        try {
            $movies = Movie::active()->get();
            $users = User::all();
            return view('backend.order.edit', compact('order', 'movies', 'users'));
        } catch (\Exception $e) {
            Log::error('Failed to load edit order form:', ['error' => $e->getMessage(), 'order_id' => $order->id ?? null]);
            return redirect()->route('order.index')->with('error', 'Failed to load order for editing.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $order = OrderItem::findOrFail($id);

            $validated = $request->validate([
                'movie_id' => 'required|exists:movies,id',
                'user_id' => 'required|exists:users,id',
                'price' => 'required|numeric|min:0',
                'status' => 'required|in:pending,completed,cancelled'
            ]);

            $order->update([
                'movie_id' => $validated['movie_id'],
                'user_id' => $validated['user_id'],
                'price' => $validated['price'],
                'status' => $validated['status']
            ]);

            DB::commit();

            return redirect()->route('order.index')
                ->with('success', 'Order updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::warning('Order update validation failed:', ['errors' => $e->errors()]);
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order update failed:', [
                'error' => $e->getMessage(),
                'order_id' => $id,
                'request_data' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update order. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $order): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $orderId = $order->id; // Store ID before deletion for logging
            $order->delete();

            DB::commit();

            Log::info('Order deleted successfully:', ['order_id' => $orderId]);
            return redirect()
                ->route('order.index')
                ->with('success', 'Order deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order deletion failed:', ['error' => $e->getMessage(), 'order_id' => $order->id]);
            return redirect()
                ->back()
                ->with('error', 'Failed to delete order. Please try again.');
        }
    }
}
