<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\Web\StripePaymentController;
use App\Http\Controllers\Web\PaymentController;


Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/transactions', [StripePaymentController::class, 'transactions'])->name('transactions');

    Route::put('/profile/edit', [UsersController::class, 'profile_edit'])->name('profile_edit');
    Route::put('/profile/change-password', [UsersController::class, 'change_password'])->name('change_password');
    Route::put('/profile/change-email', [UsersController::class, 'change_email'])->name('change_email');

    Route::get('/favorites', [UsersController::class, 'favorites'])->name('favorites');
    Route::get('/add-to-favorite', [UsersController::class, 'addToFavorite'])->name('favorite.add');
    Route::get('/remove-from-favorite', [UsersController::class, 'removeFromFavorite'])->name('favorite.remove');
    Route::get('/clear-favorite', [UsersController::class, 'clearFavorite'])->name('favorite.clear');

    Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe');
    Route::get('/succses', [StripePaymentController::class, 'succses'])->name('stripe.succses');
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
});

Route::middleware("auth:web")->group(function () {
});

Route::post('/webhook', [StripePaymentController::class, 'webhook'])->name('stripe.webhook');

Auth::routes(['verify' => true]);


Route::get('/cart', [PaymentController::class, 'cart'])->name('cart');
Route::get('/add-to-cart', [PaymentController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/remove-from-cart', [PaymentController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::get('/remove-one-from-cart', [PaymentController::class, 'removeOneFromCart'])->name('cart.removeOneFromCart');
Route::get('/clear-cart', [PaymentController::class, 'clearCart'])->name('cart.clearCart');


Route::get('/products', [ProductsController::class, 'index'])->name('product.all');
Route::get('/products/{id}', [ProductsController::class, 'category'])->name('product.category');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('web.product.show');

Route::get('/', [ProductsController::class, 'home'])->name('home');

