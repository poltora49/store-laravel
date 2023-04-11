<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\web\ProductsController;
use App\Http\Controllers\web\UsersController;
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
        Route::fallback(function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
        Route::get('transaction', [App\Http\Controllers\admin\PaymentsController::class, 'transaction'])->name('admin.transaction');
        Route::patch('user/{id}/change-password', [UsersController::class, 'change_password'])->name('user.change_password');
        Route::resource('user', App\Http\Controllers\admin\UsersController::class);
        Route::resource('category', App\Http\Controllers\admin\CategoriesController::class);
        Route::resource('product', App\Http\Controllers\admin\ProductsController::class);
    });
});
Route::middleware("auth:web")->group(function () {
    Auth::routes();
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::put('/profile/{id}/edit', [UsersController::class, 'profile_edit'])->name('profile_edit');
    // Route::put('/profile/{id}/change-password', [UsersController::class, 'change_password'])->name('change_password');
    Route::get('/favorites', [UsersController::class, 'favorites'])->name('favorites');

    Route::get('/add-to-favorite', [UsersController::class, 'addToFavorite'])->name('favorite.add');
    Route::get('/remove-from-favorite', [UsersController::class, 'removeFromFavorite'])->name('favorite.remove');
    Route::get('/clear-favorite', [UsersController::class, 'clearFavorite'])->name('favorite.clear');

});

Route::middleware("guest:web")->group(function () {

});
Auth::routes();

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
