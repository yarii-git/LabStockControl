<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CascodeController;
use App\Http\Controllers\ConsumptionController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::view('/dashboard','dashboard')->name('dashboard');
    
    Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/cascodes', [CascodeController::class, 'index'])->name('cascodes.index');
    
    Route::get('/consumptions', [ConsumptionController::class, 'index'])->name('consumptions.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users',UserController::class);
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
    // Route::post('/users/store',[UserController::class, 'store'])->name('users.store');
    // Route::put('/users/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::delete('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store',[ProductController::class, 'store'])->name('products.store');
    Route::put('/products/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::get('/cascodes/create',[CascodeController::class, 'create'])->name('cascodes.create');
    Route::post('/cascodes/store',[CascodeController::class, 'store'])->name('cascodes.store');
    Route::put('/cascodes/edit', [CascodeController::class, 'edit'])->name('cascodes.edit');

    Route::get('/consumptions/create',[ConsumptionController::class, 'create'])->name('consumptions.create');
    Route::post('/consumptions/store',[ConsumptionController::class, 'store'])->name('consumptions.store');
    Route::put('/consumptions/edit', [ConsumptionController::class, 'edit'])->name('consumptions.edit');
});

require __DIR__.'/auth.php';
