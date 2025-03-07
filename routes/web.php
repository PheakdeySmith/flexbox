<?php

use App\Http\Controllers\Backend\GenreController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ActorController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\MovieController;
use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Backend routes
    Route::prefix('backend')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
        Route::resource('genre', GenreController::class);
        Route::resource('movie', MovieController::class);
    });
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');
Route::resource('genre', GenreController::class);

Route::resource('actor', ActorController::class);

Route::get('/movie', [MovieController::class, 'index'])->name('backend.movie');


require __DIR__.'/auth.php';
