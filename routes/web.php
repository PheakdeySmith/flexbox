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
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\FavoriteController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\SubscriptionController as FrontendSubscriptionController;
use App\Http\Controllers\Frontend\OrderHistoryController;
use App\Http\Controllers\Backend\PlaylistController;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/detail/{id?}', [FrontendController::class, 'detail'])->name('frontend.detail');
Route::get('/subscription', [FrontendController::class, 'subscription'])->name('frontend.subscription');
Route::get('/frontend/login', function () {
    return redirect()->route('login');
})->name('frontend.login');
Route::get('/frontend/register', function () {
    return redirect()->route('register');
})->name('frontend.register');
Route::get('/restrict-detail', [FrontendController::class, 'restrictDetail'])->name('frontend.restrictDetail');
Route::get('/genre', [FrontendController::class, 'genre'])->name('frontend.genre');
Route::get('/director', [FrontendController::class, 'director'])->name('frontend.director');
Route::get('/actor', [FrontendController::class, 'actor'])->name('frontend.actor');
Route::get('/actor-detail/{id?}', [FrontendController::class, 'actorDetail'])->name('frontend.actorDetail');
Route::get('/director-detail/{id?}', [FrontendController::class, 'directorDetail'])->name('frontend.directorDetail');
Route::get('/404', [FrontendController::class, 'error404'])->name('frontend.404');
Route::get('/view-all', [FrontendController::class, 'viewAll'])->name('frontend.viewAll');
Route::get('/search', [FrontendController::class, 'search'])->name('frontend.search');

Route::get('/playlist-detail/{id}', [FrontendController::class, 'playlistDetail'])->name('frontend.playlistDetail');
Route::post('/playlist-store', [FrontendController::class, 'playlistStore'])->name('frontend.playlistStore');


Route::middleware(['auth'])->group(function () {

});

// Custom Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});




Route::middleware('auth')->group(function () {

    Route::put('/user/update/{id}', [UserController::class, 'updateFrontend'])->name('user.updateFrontend');
    Route::get('/watchlist', [FrontendController::class, 'watchlist'])->name('frontend.watchlist');
    Route::get('/movie', [FrontendController::class, 'movie'])->name('frontend.movie');
    Route::get('/tv-serie', [FrontendController::class, 'tvSerie'])->name('frontend.tvSerie');
    Route::get('/cart', [CheckoutController::class, 'cart'])->name('frontend.cart');
    Route::get('/add-to-cart/{id}', [CheckoutController::class, 'addToCart'])->name('frontend.addToCart');
    Route::get('/remove-from-cart/{id}', [CheckoutController::class, 'removeFromCart'])->name('frontend.removeFromCart');
    Route::get('/clear-cart', [CheckoutController::class, 'clearCart'])->name('frontend.clearCart');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('frontend.checkout');
    Route::post('/process-checkout', [CheckoutController::class, 'processCheckout'])->name('frontend.processCheckout');
    Route::get('/order-detail/{id}', [CheckoutController::class, 'orderDetail'])->name('frontend.orderDetail');
    Route::get('/purchase-history', [CheckoutController::class, 'purchaseHistory'])->name('frontend.purchaseHistory');
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::get('/profile/photo/remove', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');
    // Password routes
    Route::put('/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])->name('password.update');

    // Frontend Subscription Routesf
    Route::get('/subscription', [FrontendSubscriptionController::class, 'index'])->name('frontend.subscription');
    Route::get('/subscription/checkout/{id}', [FrontendSubscriptionController::class, 'checkout'])->name('frontend.subscriptionCheckout');
    Route::post('/subscription/subscribe/{id}', [FrontendSubscriptionController::class, 'subscribe'])->name('frontend.subscribe');
    Route::get('/subscription/detail/{id}', [FrontendSubscriptionController::class, 'subscriptionDetail'])->name('frontend.subscriptionDetail');
    Route::post('/subscription/cancel/{id}', [FrontendSubscriptionController::class, 'cancel'])->name('frontend.cancelSubscription');
    Route::get('/subscription/history', [FrontendSubscriptionController::class, 'history'])->name('frontend.subscriptionHistory');

});

// Custom Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/account', [FrontendController::class, 'account'])->name('frontend.account');
    Route::get('/watchlist', [FrontendController::class, 'watchlist'])->name('frontend.watchlist');
    Route::get('/subscription', [FrontendController::class, 'subscription'])->name('frontend.subscription');
    // Redirect /dashboard to backend/dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('backend.dashboard');
    });
    // Backend routes
    Route::prefix('backend')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
        Route::resource('genre', GenreController::class);
        Route::post('movie/updateSlideStatus', [MovieController::class, 'updateSlideStatus'])->name('movie.updateSlideStatus');
        Route::resource('movie', MovieController::class);
        Route::resource('actor', ActorController::class);
        Route::resource('director', DirectorController::class);
        Route::resource('user', UserController::class);
        Route::resource('order', OrderController::class);
        Route::resource('role', RoleController::class);

        // Business Settings routes
        Route::get('settings', [App\Http\Controllers\Backend\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [App\Http\Controllers\Backend\SettingController::class, 'update'])->name('settings.update');

        // Playlist routes
        Route::resource('playlist', PlaylistController::class);
        Route::delete('/playlist/{playlist}/movie/{movie}', [PlaylistController::class, 'removeMovie'])
            ->name('playlist.removeMovie');

        // Watchlist routes
        Route::resource('watchlist', WatchlistController::class);
        Route::post('watchlist/toggle/{movie}', [WatchlistController::class, 'toggle'])->name('watchlist.toggle');
        // Favorite routes
        Route::resource('favorite', FavoriteController::class);
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

        // Reports routes
        Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/movie-revenue', [App\Http\Controllers\Backend\ReportController::class, 'movieRevenue'])->name('reports.movie-revenue');
        Route::get('reports/subscription-analytics', [App\Http\Controllers\Backend\ReportController::class, 'subscriptionAnalytics'])->name('reports.subscription-analytics');
        Route::get('reports/user-activity', [App\Http\Controllers\Backend\ReportController::class, 'userActivity'])->name('reports.user-activity');
        Route::get('reports/content-performance', [App\Http\Controllers\Backend\ReportController::class, 'contentPerformance'])->name('reports.content-performance');

        // Print reports routes
        Route::get('reports/print/movie-revenue', [App\Http\Controllers\Backend\ReportController::class, 'printMovieRevenue'])->name('reports.print.movie-revenue');
        Route::get('reports/print/subscription-analytics', [App\Http\Controllers\Backend\ReportController::class, 'printSubscriptionAnalytics'])->name('reports.print.subscription-analytics');
        Route::get('reports/print/user-activity', [App\Http\Controllers\Backend\ReportController::class, 'printUserActivity'])->name('reports.print.user-activity');
        Route::get('reports/print/content-performance', [App\Http\Controllers\Backend\ReportController::class, 'printContentPerformance'])->name('reports.print.content-performance');

        // Payment routes
        Route::resource('payment', PaymentController::class);
        Route::post('payment/refund/{payment}', [PaymentController::class, 'refund'])->name('payment.refund');
        Route::post('payment/mark-as-completed/{payment}', [PaymentController::class, 'markAsCompleted'])->name('payment.mark-as-completed');
        // Additional payment routes
        Route::get('payments/dashboard', [PaymentController::class, 'dashboard'])->name('payment.dashboard');
        Route::patch('payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payment.update-status');
        Route::get('users/{user}/payments', [PaymentController::class, 'userHistory'])->name('payment.user-history');
        // Additional order routes
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('order.update-status');
        // View the authenticated user's profile
        Route::get('/user/profile', [ProfileController::class, 'profile'])->name('user.profile');
        // Update the authenticated user's profile
        Route::put('/user/profile', [ProfileController::class, 'updateProfile'])->name('user.updateProfile');
    });

    // Frontend Order History Routes
    Route::get('/orders', [OrderHistoryController::class, 'index'])
        ->name('frontend.orders.history');
    Route::get('/orders/{order}', [OrderHistoryController::class, 'show'])
        ->name('frontend.orders.show');
    Route::patch('/orders/{order}/cancel', [OrderHistoryController::class, 'cancel'])
        ->name('frontend.orders.cancel');

    // Movie watching route
    Route::get('/movies/{movie}/watch', [App\Http\Controllers\Frontend\MovieController::class, 'watch'])
        ->name('frontend.movies.watch');
});
