<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthAuthenticatedSessionController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('welcome'));
    require __DIR__ . '/auth.php';
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout (POST only)
Route::post('/logout', [AuthAuthenticatedSessionController::class, 'destroy'])->name('logout');



    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');


    // Admin Routes
    Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Foods CRUD
        Route::resource('foods', FoodController::class)->except(['show']);
        Route::resource('categories', CategoryController::class)->except(['show']);

        // Admin Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}/edit', [AdminOrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])
    ->name('orders.destroy');

        // Filter foods by category
        Route::get('/menu/category/{id}', [FoodController::class, 'filterByCategory'])->name('menu.category');
    });

/// customer routes
Route::prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   // Menu
    Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
    Route::get('/foods/category/{id}', [FoodController::class, 'filterByCategory'])->name('foods.category');

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/place-order', [CartController::class, 'placeOrderJs'])->name('cart.placeOrder');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Orders
    Route::get('/orders', [CartController::class, 'myOrders'])->name('orders.index');
    Route::delete('/orders/{id}/cancel', [CartController::class, 'cancelOrder'])->name('orders.cancel');




});

});