<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application.
|
*/



// Dashboard Routes
Route::get('/home', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/detail', [FrontendController::class, 'detail'])->name('frontend.detail');
Route::get('/movies', [FrontendController::class, 'movie'])->name('frontend.movie');
Route::get('/tv_series', [FrontendController::class, 'tv_serie'])->name('frontend.tv_serie');
