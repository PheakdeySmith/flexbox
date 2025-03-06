<?php

use App\Http\Controllers\GenresController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //genres
    Route::get('/genres', [GenresController::class, 'index'])->name('genres.index');


});

// Include Backend Routes with prefix
Route::prefix('backend')->group(function () {
    require __DIR__.'/backend.php';
});

require __DIR__.'/auth.php';
