<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
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
});


Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->is_admin == 1) {
        return app(AdminController::class)->index();
    } else {
        return redirect()->route('dashboard');
    }
})->name('admin');

Route::post('/admin', [AdminController::class, 'create']);

require __DIR__.'/auth.php';
