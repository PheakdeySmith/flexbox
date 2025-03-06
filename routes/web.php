<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Include Backend Routes with prefix
Route::prefix('backend')->group(function () {
    require __DIR__.'/backend.php';
});

Route::prefix('frontend')->group(function () {
    require __DIR__.'/frontend.php';
});

