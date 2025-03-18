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

    // Frontend Subscription Routes
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
    Route::prefix('backend')->middleware('can:access backend')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('backend.dashboard')
            ->middleware('can:view dashboard');

        // Genre routes
        Route::get('genre', [GenreController::class, 'index'])
            ->name('genre.index')
            ->middleware('can:view genre');
        Route::get('genre/create', [GenreController::class, 'create'])
            ->name('genre.create')
            ->middleware('can:create genre');
        Route::post('genre', [GenreController::class, 'store'])
            ->name('genre.store')
            ->middleware('can:create genre');
        Route::get('genre/{genre}/edit', [GenreController::class, 'edit'])
            ->name('genre.edit')
            ->middleware('can:edit genre');
        Route::put('genre/{genre}', [GenreController::class, 'update'])
            ->name('genre.update')
            ->middleware('can:edit genre');
        Route::delete('genre/{genre}', [GenreController::class, 'destroy'])
            ->name('genre.destroy')
            ->middleware('can:delete genre');
        Route::get('genre/{genre}', [GenreController::class, 'show'])
            ->name('genre.show')
            ->middleware('can:view genre');

        // Movie routes
        Route::post('movie/updateSlideStatus', [MovieController::class, 'updateSlideStatus'])
            ->name('movie.updateSlideStatus')
            ->middleware('can:update movie status');

        Route::get('movie', [MovieController::class, 'index'])
            ->name('movie.index')
            ->middleware('can:view movie');
        Route::get('movie/create', [MovieController::class, 'create'])
            ->name('movie.create')
            ->middleware('can:create movie');
        Route::post('movie', [MovieController::class, 'store'])
            ->name('movie.store')
            ->middleware('can:create movie');
        Route::get('movie/{movie}/edit', [MovieController::class, 'edit'])
            ->name('movie.edit')
            ->middleware('can:edit movie');
        Route::put('movie/{movie}', [MovieController::class, 'update'])
            ->name('movie.update')
            ->middleware('can:edit movie');
        Route::delete('movie/{movie}', [MovieController::class, 'destroy'])
            ->name('movie.destroy')
            ->middleware('can:delete movie');
        Route::get('movie/{movie}', [MovieController::class, 'show'])
            ->name('movie.show')
            ->middleware('can:view movie');

        // Actor routes
        Route::resource('actor', ActorController::class)->middleware([
            'index' => 'can:view actor',
            'create' => 'can:create actor',
            'store' => 'can:create actor',
            'show' => 'can:view actor',
            'edit' => 'can:edit actor',
            'update' => 'can:edit actor',
            'destroy' => 'can:delete actor',
        ]);

        // Director routes
        Route::resource('director', DirectorController::class)->middleware([
            'index' => 'can:view director',
            'create' => 'can:create director',
            'store' => 'can:create director',
            'show' => 'can:view director',
            'edit' => 'can:edit director',
            'update' => 'can:edit director',
            'destroy' => 'can:delete director',
        ]);

        // User routes
        Route::resource('user', UserController::class)->middleware([
            'index' => 'can:view user',
            'create' => 'can:create user',
            'store' => 'can:create user',
            'show' => 'can:view user',
            'edit' => 'can:edit user',
            'update' => 'can:edit user',
            'destroy' => 'can:delete user',
        ]);

        // Order routes
        Route::resource('order', OrderController::class)->middleware([
            'index' => 'can:view order',
            'create' => 'can:create order',
            'store' => 'can:create order',
            'show' => 'can:view order',
            'edit' => 'can:edit order',
            'update' => 'can:edit order',
            'destroy' => 'can:delete order',
        ]);

        // Role routes
        Route::resource('role', RoleController::class)->middleware([
            'index' => 'can:view role',
            'create' => 'can:create role',
            'store' => 'can:create role',
            'show' => 'can:view role',
            'edit' => 'can:edit role',
            'update' => 'can:edit role',
            'destroy' => 'can:delete role',
        ]);

        // Business Settings routes
        Route::get('settings', [App\Http\Controllers\Backend\SettingController::class, 'edit'])
            ->name('settings.edit')
            ->middleware('can:manage settings');
        Route::put('settings', [App\Http\Controllers\Backend\SettingController::class, 'update'])
            ->name('settings.update')
            ->middleware('can:manage settings');

        // Playlist routes
        Route::resource('playlist', PlaylistController::class)->middleware([
            'index' => 'can:view playlist',
            'create' => 'can:create playlist',
            'store' => 'can:create playlist',
            'show' => 'can:view playlist',
            'edit' => 'can:edit playlist',
            'update' => 'can:edit playlist',
            'destroy' => 'can:delete playlist',
        ]);
        Route::delete('/playlist/{playlist}/movie/{movie}', [PlaylistController::class, 'removeMovie'])
            ->name('playlist.removeMovie')
            ->middleware('can:edit playlist');

        // Watchlist routes
        Route::resource('watchlist', WatchlistController::class)->middleware([
            'index' => 'can:view watchlist',
            'create' => 'can:create watchlist',
            'store' => 'can:create watchlist',
            'show' => 'can:view watchlist',
            'edit' => 'can:edit watchlist',
            'update' => 'can:edit watchlist',
            'destroy' => 'can:delete watchlist',
        ]);
        Route::post('watchlist/toggle/{movie}', [WatchlistController::class, 'toggle'])
            ->name('watchlist.toggle')
            ->middleware('can:create watchlist');

        // Favorite routes
        Route::resource('favorite', FavoriteController::class)->middleware([
            'index' => 'can:view favorite',
            'create' => 'can:create favorite',
            'store' => 'can:create favorite',
            'show' => 'can:view favorite',
            'edit' => 'can:edit favorite',
            'update' => 'can:edit favorite',
            'destroy' => 'can:delete favorite',
        ]);

        // Review routes
        Route::resource('review', ReviewController::class)->middleware([
            'index' => 'can:view review',
            'create' => 'can:create review',
            'store' => 'can:create review',
            'show' => 'can:view review',
            'edit' => 'can:edit review',
            'update' => 'can:edit review',
            'destroy' => 'can:delete review',
        ]);
        Route::post('review/toggle-approval/{review}', [ReviewController::class, 'toggleApproval'])
            ->name('review.toggle-approval')
            ->middleware('can:approve reviews');
        Route::post('review/submit/{movie}', [ReviewController::class, 'submitReview'])
            ->name('review.submit')
            ->middleware('can:create review');

        // Subscription Plan routes
        Route::resource('subscription-plan', SubscriptionPlanController::class)->middleware([
            'index' => 'can:view subscription-plan',
            'create' => 'can:create subscription-plan',
            'store' => 'can:create subscription-plan',
            'show' => 'can:view subscription-plan',
            'edit' => 'can:edit subscription-plan',
            'update' => 'can:edit subscription-plan',
            'destroy' => 'can:delete subscription-plan',
        ]);
        Route::post('subscription-plan/toggle-active/{subscriptionPlan}', [SubscriptionPlanController::class, 'toggleActive'])
            ->name('subscription-plan.toggle-active')
            ->middleware('can:edit subscription-plan');

        // Subscription routes
        Route::resource('subscription', SubscriptionController::class)->middleware([
            'index' => 'can:view subscription',
            'create' => 'can:create subscription',
            'store' => 'can:create subscription',
            'show' => 'can:view subscription',
            'edit' => 'can:edit subscription',
            'update' => 'can:edit subscription',
            'destroy' => 'can:delete subscription',
        ]);
        Route::post('subscription/cancel/{subscription}', [SubscriptionController::class, 'cancel'])
            ->name('subscription.cancel')
            ->middleware('can:cancel subscriptions');
        Route::post('subscription/extend/{subscription}', [SubscriptionController::class, 'extend'])
            ->name('subscription.extend')
            ->middleware('can:extend subscriptions');

        // Reports routes
        Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])
            ->name('reports.index')
            ->middleware('can:view reports');
        Route::get('reports/movie-revenue', [App\Http\Controllers\Backend\ReportController::class, 'movieRevenue'])
            ->name('reports.movie-revenue')
            ->middleware('can:view reports');
        Route::get('reports/subscription-analytics', [App\Http\Controllers\Backend\ReportController::class, 'subscriptionAnalytics'])
            ->name('reports.subscription-analytics')
            ->middleware('can:view reports');
        Route::get('reports/user-activity', [App\Http\Controllers\Backend\ReportController::class, 'userActivity'])
            ->name('reports.user-activity')
            ->middleware('can:view reports');
        Route::get('reports/content-performance', [App\Http\Controllers\Backend\ReportController::class, 'contentPerformance'])
            ->name('reports.content-performance')
            ->middleware('can:view reports');

        // Print reports routes
        Route::get('reports/print/movie-revenue', [App\Http\Controllers\Backend\ReportController::class, 'printMovieRevenue'])
            ->name('reports.print.movie-revenue')
            ->middleware('can:generate reports');
        Route::get('reports/print/subscription-analytics', [App\Http\Controllers\Backend\ReportController::class, 'printSubscriptionAnalytics'])
            ->name('reports.print.subscription-analytics')
            ->middleware('can:generate reports');
        Route::get('reports/print/user-activity', [App\Http\Controllers\Backend\ReportController::class, 'printUserActivity'])
            ->name('reports.print.user-activity')
            ->middleware('can:generate reports');
        Route::get('reports/print/content-performance', [App\Http\Controllers\Backend\ReportController::class, 'printContentPerformance'])
            ->name('reports.print.content-performance')
            ->middleware('can:generate reports');

        // Payment routes
        Route::resource('payment', PaymentController::class)->middleware([
            'index' => 'can:view payment',
            'create' => 'can:create payment',
            'store' => 'can:create payment',
            'show' => 'can:view payment',
            'edit' => 'can:edit payment',
            'update' => 'can:edit payment',
            'destroy' => 'can:delete payment',
        ]);
        Route::post('payment/refund/{payment}', [PaymentController::class, 'refund'])
            ->name('payment.refund')
            ->middleware('can:issue refunds');
        Route::post('payment/mark-as-completed/{payment}', [PaymentController::class, 'markAsCompleted'])
            ->name('payment.mark-as-completed')
            ->middleware('can:process payments');

        // Additional payment routes
        Route::get('payments/dashboard', [PaymentController::class, 'dashboard'])
            ->name('payment.dashboard')
            ->middleware('can:view analytics');
        Route::patch('payments/{payment}/status', [PaymentController::class, 'updateStatus'])
            ->name('payment.update-status')
            ->middleware('can:process payments');
        Route::get('users/{user}/payments', [PaymentController::class, 'userHistory'])
            ->name('payment.user-history')
            ->middleware('can:view payment');

        // Additional order routes
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('order.update-status')
            ->middleware('can:edit order');

        // View the authenticated user's profile
        Route::get('/user/profile', [ProfileController::class, 'profile'])
            ->name('user.profile');

        // Update the authenticated user's profile
        Route::put('/user/profile', [ProfileController::class, 'updateProfile'])
            ->name('user.updateProfile');
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

// Demo routes for infinite scroll
Route::get('/actor-demo', [FrontendController::class, 'actorDemo'])->name('frontend.actorDemo');
Route::get('/director-demo', [FrontendController::class, 'directorDemo'])->name('frontend.directorDemo');
