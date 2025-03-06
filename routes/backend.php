<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application.
|
*/

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('backend.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('backend.register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('backend.logout');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

// Add more backend routes as needed
