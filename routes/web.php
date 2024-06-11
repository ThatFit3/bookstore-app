<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BookController::class , 'indexDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin page and actions
Route::get('/admin', [AdminController::class , 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'create']);

//Book's detail page
Route::get('/books/{book}', [BookController::class , 'indexDetail']);

//review's actions
Route::post('/review/{book}', [ReviewController::class, 'post']);
Route::put('/review/{book}', [ReviewController::class, 'update']);
Route::delete('/review/{book}', [ReviewController::class, 'destroy']);

//shop's action
Route::post('/shop' , [ShopController::class, 'create']);

require __DIR__.'/auth.php';
