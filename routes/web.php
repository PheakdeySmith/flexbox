<?php

use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ActorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MovieController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DirectorController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\WatchlistController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SubscriptionPlanController;
use App\Http\Controllers\Backend\SubscriptionController;
use App\Http\Controllers\Backend\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/detail', [FrontendController::class, 'detail'])->name('frontend.detail');

Route::get('/frontend/login', function () {
    return redirect()->route('login');
})->name('frontend.login');
Route::get('/frontend/register', function () {
    return redirect()->route('register');
})->name('frontend.register');
Route::get('/restrict-detail', [FrontendController::class, 'restrictDetail'])->name('frontend.restrictDetail');
Route::get('/genre', [FrontendController::class, 'genre'])->name('frontend.genre');
Route::get('/actor', [FrontendController::class, 'actor'])->name('frontend.actor');
Route::get('/404', [FrontendController::class, 'error404'])->name('frontend.404');
Route::get('/movie', [FrontendController::class, 'movie'])->name('frontend.movie');
Route::get('/tv-serie', [FrontendController::class, 'tvSerie'])->name('frontend.tvSerie');
Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('frontend.checkout');
Route::get('/order-detail', [FrontendController::class, 'orderDetail'])->name('frontend.orderDetail');

// Custom Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/account', [UserController::class, 'front_edit'])->name('frontend.account');
    Route::get('/watchlist', [FrontendController::class, 'watchlist'])->name('frontend.watchlist');
    Route::get('/subscription', [FrontendController::class, 'subscription'])->name('frontend.subscription');

    // Redirect /dashboard to backend/dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('backend.dashboard');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::get('/profile/photo/remove', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');

    // Password routes
    Route::put('/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    // Backend routes
    Route::prefix('backend')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
        Route::resource('genre', GenreController::class);
        Route::resource('movie', MovieController::class);
        Route::resource('actor', ActorController::class);
        Route::resource('director', DirectorController::class);
        Route::resource('user', UserController::class);

        // Watchlist routes
        Route::resource('watchlist', WatchlistController::class);
        Route::post('watchlist/toggle/{movie}', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');

        // Review routes
        Route::resource('review', ReviewController::class);
        Route::post('review/toggle-approval/{review}', [ReviewController::class, 'toggleApproval'])->name('review.toggle-approval');
        Route::post('review/submit/{movie}', [ReviewController::class, 'submitReview'])->name('review.submit');

        // Subscription Plan routes
        Route::resource('subscription-plan', SubscriptionPlanController::class);
        Route::post('subscription-plan/toggle-active/{subscriptionPlan}', [SubscriptionPlanController::class, 'toggleActive'])->name('subscription-plan.toggle-active');

        // Subscription routes
        Route::resource('subscription', SubscriptionController::class);
        Route::post('subscription/cancel/{subscription}', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        Route::post('subscription/extend/{subscription}', [SubscriptionController::class, 'extend'])->name('subscription.extend');

        // Payment routes
        Route::resource('payment', PaymentController::class);
        Route::post('payment/refund/{payment}', [PaymentController::class, 'refund'])->name('payment.refund');
        Route::post('payment/mark-as-completed/{payment}', [PaymentController::class, 'markAsCompleted'])->name('payment.mark-as-completed');



        // View the authenticated user's profile
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        // Update the authenticated user's profile
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    });
});
