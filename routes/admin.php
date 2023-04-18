<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\StripePaymentController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoriesController;


Route::get('login', [AdminLoginController::class, 'login'])->name('admin.auth.login');
Route::post('login', [AdminLoginController::class, 'loginAdmin'])->name('admin.auth.loginAdmin');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::post('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');

    Route::get('transaction', [PaymentsController::class, 'transaction'])->name('admin.transaction');

    Route::patch('user/{id}/change-password', [UsersController::class, 'change_password'])->name('user.change_password');
    Route::patch('user/{id}/block', [UsersController::class, 'block'])->name('user.block');
    Route::patch('user/{id}/change-email', [UsersController::class, 'change_email'])->name('user.change_email');
    Route::resource('user', UsersController::class);

    Route::resource('product', ProductsController::class);
    Route::get('product/hide/{id}', [ProductsController::class, 'hide'])->name('product.hide');

    Route::resource('category', CategoriesController::class);
});
