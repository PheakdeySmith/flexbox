<?php

use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ActorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MovieController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DirectorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/detail', [FrontendController::class, 'detail'])->name('frontend.detail');
Route::get('/watchlist', [FrontendController::class, 'watchlist'])->name('frontend.watchlist');
Route::get('/account', [FrontendController::class, 'account'])->name('frontend.account');
Route::get('/subscription', [FrontendController::class, 'subscription'])->name('frontend.subscription');
Route::get('/frontend/login', [FrontendController::class, 'login'])->name('frontend.login');
Route::get('/frontend/register', [FrontendController::class, 'register'])->name('frontend.register');
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

    // Redirect /dashboard to backend/dashboard
    Route::get('/dashboard', function() {
        return redirect()->route('backend.dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Backend routes
    Route::prefix('backend')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
        Route::resource('genre', GenreController::class);
        Route::resource('movie', MovieController::class);
        Route::resource('actor', ActorController::class);
        Route::resource('director', DirectorController::class);
        Route::resource('user', UserController::class);
    });

});
