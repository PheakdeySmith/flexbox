<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Movie;
use Dotenv\Exception\ValidationException;
use Exception;
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
        try {
            $orders = OrderItem::with(['movie' => function ($query) {
                $query->withTrashed();
            }])->latest()->get();

            $movies = Movie::active()->get();

            return view('backend.order.index', compact('orders', 'movies'));
        } catch (\Exception $e) {
            Log::error('Failed to fetch orders:', ['error' => $e->getMessage()]);
            return view('backend.order.index')->with('error', 'Failed to load orders. Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        try {
            $movies = Movie::active()->get();
            return view('backend.order.create', compact('movies'));
        } catch (\Exception $e) {
            Log::error('Failed to load create order form:', ['error' => $e->getMessage()]);
            return view('backend.order.create')->with('error', 'Failed to load movies. Please try again.');
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
                'price' => 'required|numeric|min:0'
            ]);

            // Verify movie exists and get its details
            $movie = Movie::findOrFail($validated['movie_id']);

            // Verify price matches movie price
            if ($movie->price != $validated['price']) {
                throw new \Exception('Invalid price for the selected movie');
            }

            // Create order
            $order = OrderItem::create([
                'movie_id' => $validated['movie_id'],
                'price' => $validated['price']
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
            }]);
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
        return view('backend.order.edit', compact('order', 'movies'));
    } catch (\Exception $e) {
        Log::error('Failed to load edit order form:', ['error' => $e->getMessage(), 'order_id' => $order->id ?? null]);
        return redirect()->route('order.index')->with('error', 'Failed to load order for editing.');
    }
}

public function update(Request $request, $id)
    {
        $order = OrderItem::findOrFail($id);

        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'price' => 'required|numeric|min:0'
        ]);

        $order->update([
            'movie_id' => $request->movie_id,
            'price' => $request->price,
        ]);

        return redirect()->route('order.index')
            ->with('success', 'Order updated successfully.');
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
