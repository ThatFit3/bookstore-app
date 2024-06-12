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

    //shop's and order's action
    Route::get('/order' , [ShopController::class, 'indexOrder'])->name('order');
    Route::put('/order/{order}/shipped' , [ShopController::class, 'shipOrder']);
    Route::post('/shop' , [ShopController::class, 'create']);
    Route::get('/shop' , [ShopController::class, 'indexShop'])->name('shop');
    Route::delete('/shop/{item}/oof' , [ShopController::class, 'out']);
    Route::patch('/shop/{item}/oof' , [ShopController::class, 'back']);
    Route::put('/shop/{item}/edit' , [ShopController::class, 'edit']);
    Route::put('/shop/{shop}' , [ShopController::class, 'editShop']);
    Route::put('/shop/{shop}/add' , [ShopController::class, 'createItem']);

    Route::middleware(AdminMiddleware::class)->group(function() {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::post('/admin', [AdminController::class, 'create']);
        Route::put('/admin/{book}', [AdminController::class, 'update'])->name('admin.edit');
        Route::delete('/admin/{book}/oof', [AdminController::class, 'destroy'])->name('admin.delete');
    });

    //purchases' action
    Route::get('/purchase' , [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/purchase/pending' , [PurchaseController::class, 'index'])->name('purchase.pending');
    Route::post('/purchase/{book}' , [PurchaseController::class, 'create']);
    Route::put('/purchase/{purchase}/arrive' , [PurchaseController::class, 'purchaseArrive']);
});
// Route::middleware(['auth', 'verified'])->group(function() {
// });
// //Admin page and actions
// Route::get('/admin', [AdminController::class , 'index'])->name('admin');
// Route::post('/admin', [AdminController::class, 'create']);
// Route::put('/admin/{book}', [AdminController::class, 'update']);
// Route::delete('/admin/{book}', [AdminController::class, 'destroy']);

require __DIR__.'/auth.php';
