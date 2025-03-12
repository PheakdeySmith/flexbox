<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display the cart page.
     */
    public function cart()
    {
        // Get the cart items from the session
        $cartItems = Session::get('cart', []);
        Log::info('Cart items in cart method: ' . json_encode($cartItems));

        $movies = [];
        $total = 0;

        foreach ($cartItems as $id => $item) {
            $movie = Movie::find($id);
            if ($movie) {
                // Use the price from the cart item or the movie price
                $price = $item['price'] ?? $movie->price;

                $movies[] = [
                    'id' => $movie->id,
                    'title' => $movie->title,
                    'poster' => $movie->poster_url,
                    'price' => $price,
                ];
                $total += (float)$price;
                Log::info('Added movie to display: ' . $movie->title . ' with price: ' . $price);
            }
        }

        Log::info('Movies to display: ' . json_encode($movies));
        Log::info('Total: ' . $total);

        return view('frontend.cart.index', compact('movies', 'total'));
    }

    /**
     * Add a movie to the cart.
     */
    public function addToCart(Request $request, $id)
    {
        Log::info('Adding movie to cart: ' . $id);

        $movie = Movie::findOrFail($id);
        Log::info('Movie found: ' . $movie->title);

        $cart = Session::get('cart', []);
        Log::info('Current cart: ' . json_encode($cart));

        // Check if movie is already in cart
        if (isset($cart[$id])) {
            Log::info('Movie already in cart');
            return redirect()->back()->with('info', 'Movie is already in your cart.');
        }

        // Skip the canWatchMovie check for now
        // if (Auth::check()) {
        //     try {
        //         if (Auth::user()->canWatchMovie($movie)) {
        //             Log::info('User can already watch this movie');
        //             return redirect()->back()->with('info', 'You already have access to this movie.');
        //         }
        //     } catch (\Exception $e) {
        //         Log::error('Error checking if user can watch movie: ' . $e->getMessage());
        //     }
        // }

        // Ensure the movie has a price
        $price = $movie->price ?? 9.99;

        $cart[$id] = [
            'id' => $movie->id,
            'title' => $movie->title,
            'price' => $price,
        ];

        Log::info('Updated cart: ' . json_encode($cart));

        // Save the cart to the session
        Session::put('cart', $cart);
        Session::save();

        Log::info('Cart saved to session');

        // Redirect to the cart page
        return redirect()->route('frontend.cart')->with('success', 'Movie added to cart successfully.');
    }

    /**
     * Remove a movie from the cart.
     */
    public function removeFromCart($id)
    {
        Log::info('Removing movie from cart: ' . $id);

        $cart = Session::get('cart', []);
        Log::info('Current cart before removal: ' . json_encode($cart));

        if (isset($cart[$id])) {
            Log::info('Movie found in cart, removing: ' . $cart[$id]['title']);
            unset($cart[$id]);
            Session::put('cart', $cart);
            Session::save();
            Log::info('Cart after removal: ' . json_encode($cart));
            return redirect()->route('frontend.cart')->with('success', 'Movie removed from cart successfully.');
        } else {
            Log::warning('Movie not found in cart: ' . $id);
            return redirect()->route('frontend.cart')->with('error', 'Movie not found in cart.');
        }
    }

    /**
     * Clear the cart.
     */
    public function clearCart()
    {
        Log::info('Clearing cart');
        Session::forget('cart');
        Session::save();
        Log::info('Cart cleared');
        return redirect()->route('frontend.cart')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $cartItems = Session::get('cart', []);
        Log::info('Cart items in checkout method: ' . json_encode($cartItems));

        if (empty($cartItems)) {
            return redirect()->route('frontend.cart')->with('error', 'Your cart is empty.');
        }

        $movies = [];
        $total = 0;

        foreach ($cartItems as $id => $item) {
            $movie = Movie::find($id);
            if ($movie) {
                // Use the price from the cart item or the movie price
                $price = $item['price'] ?? $movie->price;

                $movies[] = [
                    'id' => $movie->id,
                    'title' => $movie->title,
                    'poster' => $movie->poster_url,
                    'price' => $price,
                ];
                $total += (float)$price;
                Log::info('Added movie to checkout display: ' . $movie->title . ' with price: ' . $price);
            }
        }

        Log::info('Movies to display in checkout: ' . json_encode($movies));
        Log::info('Total in checkout: ' . $total);

        return view('frontend.cart.checkout', compact('movies', 'total'));
    }

    /**
     * Process the checkout.
     */
    public function processCheckout(Request $request)
    {
        Log::info('Processing checkout');

        if (!Auth::check()) {
            Log::warning('User not logged in during checkout');
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $cartItems = Session::get('cart', []);
        Log::info('Cart items in processCheckout: ' . json_encode($cartItems));

        if (empty($cartItems)) {
            Log::warning('Empty cart during checkout');
            return redirect()->route('frontend.cart')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'payment_method' => 'required|in:credit_card,paypal',
        ]);

        Log::info('Payment method: ' . $request->payment_method);

        DB::beginTransaction();

        try {
            // Calculate total
            $total = 0;
            $movieIds = [];

            foreach ($cartItems as $id => $item) {
                $movie = Movie::find($id);
                if ($movie) {
                    // Use the price from the cart item or the movie price
                    $price = $item['price'] ?? $movie->price;
                    $total += (float)$price;
                    $movieIds[] = $movie->id;
                    Log::info('Added movie to order: ' . $movie->title . ' with price: ' . $price);
                }
            }

            Log::info('Total order amount: ' . $total);

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            Log::info('Created order: ' . $order->id);

            // Create order items
            foreach ($cartItems as $id => $item) {
                $movie = Movie::find($id);
                if ($movie) {
                    $price = $item['price'] ?? $movie->price;
                    OrderItem::create([
                        'order_id' => $order->id,
                        'movie_id' => $movie->id,
                        'user_id' => Auth::id(),
                        'price' => $price,
                        'status' => 'pending',
                    ]);
                    Log::info('Created order item for movie: ' . $movie->title);
                }
            }

            // Process payment (mock for now)
            $paymentSuccessful = true;
            $transactionId = 'txn_' . uniqid();
            Log::info('Transaction ID: ' . $transactionId);

            if ($paymentSuccessful) {
                // Create payment record
                $payment = Payment::create([
                    'user_id' => Auth::id(),
                    'payment_method' => $request->payment_method,
                    'payment_type' => 'movie_purchase',
                    'transaction_id' => $transactionId,
                    'amount' => $total,
                    'currency' => 'USD',
                    'status' => 'completed',
                    'notes' => 'Movie purchase',
                ]);

                Log::info('Created payment: ' . $payment->id);

                // Link payment to order
                PaymentDetail::create([
                    'payment_id' => $payment->id,
                    'payable_id' => $order->id,
                    'payable_type' => Order::class,
                ]);

                Log::info('Linked payment to order');

                // Update order status
                $order->update(['status' => 'completed']);
                $order->items()->update(['status' => 'completed']);

                Log::info('Updated order status to completed');

                // Clear cart
                Session::forget('cart');
                Session::save();

                Log::info('Cleared cart');

                DB::commit();
                Log::info('Checkout completed successfully');

                return redirect()->route('frontend.orderDetail', ['id' => $order->id])
                    ->with('success', 'Order placed successfully!');
            } else {
                DB::rollBack();
                Log::error('Payment failed');
                return redirect()->back()->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during checkout: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the order detail page.
     */
    public function orderDetail($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::with(['items.movie', 'paymentDetail.payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('frontend.cart.order-detail', compact('order'));
    }

    /**
     * Display the user's purchase history.
     */
    public function purchaseHistory()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::with(['items.movie'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('frontend.cart.purchase-history', compact('orders'));
    }
}
