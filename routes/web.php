<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PurchaseController;
use App\Http\Middleware\AdminMiddleware;
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

Route::middleware(['auth', 'verified'])->group(function() {
    //Book's detail page
    Route::get('/books/{book}', [BookController::class , 'indexDetail']);

    //review's actions
    Route::post('/review/{book}', [ReviewController::class, 'post']);
    Route::put('/review/{book}', [ReviewController::class, 'update']);
    Route::delete('/review/{book}', [ReviewController::class, 'destroy']);

    //shop's action
    Route::post('/shop' , [ShopController::class, 'create']);

    Route::middleware(AdminMiddleware::class)->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::post('/admin', [AdminController::class, 'create']);
        Route::put('/admin/{book}', [AdminController::class, 'update'])->name('admin.edit');
        Route::delete('/admin/{book}', [AdminController::class, 'destroy'])->name('admin.delete');
    });

    //purchases' action
    Route::get('/purchase' , [PurchaseController::class, 'index']);
    Route::post('/purchase/{book}' , [PurchaseController::class, 'create']);
});
// Route::middleware(['auth', 'verified'])->group(function() {
// });
// //Admin page and actions
// Route::get('/admin', [AdminController::class , 'index'])->name('admin');
// Route::post('/admin', [AdminController::class, 'create']);
// Route::put('/admin/{book}', [AdminController::class, 'update']);
// Route::delete('/admin/{book}', [AdminController::class, 'destroy']);

require __DIR__.'/auth.php';
