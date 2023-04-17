<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\web\ProductsController;
use App\Http\Controllers\web\UsersController;
use App\Http\ControllersPaymentController;
use App\Http\Controllers\web\StripePaymentController;
use App\Http\Controllers\web\PaymentController;
use App\Http\Controllers\Auth\AdminLoginController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'login'])->name('admin.auth.login');
    Route::post('login', [AdminLoginController::class, 'loginAdmin'])->name('admin.auth.loginAdmin');


    Route::group(['middleware' => ['auth:admin']], function () {
        Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('product/hide/{id}', [App\Http\Controllers\admin\ProductsController::class, 'hide'])->name('product.hide');
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
        Route::get('transaction', [App\Http\Controllers\admin\PaymentsController::class, 'transaction'])->name('admin.transaction');
        Route::patch('user/{id}/change-password', [App\Http\Controllers\admin\UsersController::class, 'change_password'])->name('user.change_password');
        Route::patch('user/{id}/block', [App\Http\Controllers\admin\UsersController::class, 'block'])->name('user.block');
        Route::patch('user/{id}/change-email', [App\Http\Controllers\admin\UsersController::class, 'change_email'])->name('user.change_email');
        Route::resource('user', App\Http\Controllers\admin\UsersController::class);
        Route::resource('category', App\Http\Controllers\admin\CategoriesController::class);
        Route::resource('product', App\Http\Controllers\admin\ProductsController::class);
        Route::fallback(function () {
            return redirect()->route('admin.dashboard');
        });
    });
});
Route::group(['middleware' => ['auth', 'verified']], function () {
    Auth::routes();
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
});
Route::post('/webhook', [StripePaymentController::class, 'webhook'])->name('stripe.webhook');
Route::middleware("auth:web")->group(function () {
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
});
Route::middleware("guest:web")->group(function () {

});
Auth::routes(['verify' => true]);

Route::get('/', [ProductsController::class, 'home'])->name('home');
Route::get('/cart', [PaymentController::class, 'cart'])->name('cart');

Route::get('/add-to-cart', [PaymentController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/remove-from-cart', [PaymentController::class, 'removeFromCart'])->name('cart.removeFromCart');
Route::get('/remove-one-from-cart', [PaymentController::class, 'removeOneFromCart'])->name('cart.removeOneFromCart');
Route::get('/clear-cart', [PaymentController::class, 'clearCart'])->name('cart.clearCart');


Route::get('/products', [ProductsController::class, 'index'])->name('product.all');
Route::get('/products/{id}', [ProductsController::class, 'category'])->name('product.category');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('web.product.show');
Route::fallback(function () {
    return redirect()->route('home');
});
