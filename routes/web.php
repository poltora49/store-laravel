<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\web\ProductsController;
use App\Http\Controllers\web\UsersController;
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
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.auth.logout');
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('admin/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
Route::middleware("auth:web")->group(function () {
    Auth::routes();
    Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
    Route::patch('/profile/edit', [UsersController::class, 'profile_edit'])->name('profile_edit');
    Route::patch('/profile/change-password', [UsersController::class, 'change_password'])->name('change_password');
    Route::get('/favorites', [UsersController::class, 'favorites'])->name('favorites');
});

Route::middleware("guest:web")->group(function () {

});
Auth::routes();
Route::get('/', [ProductsController::class, 'home'])->name('home');
Route::get('/products', [ProductsController::class, 'index'])->name('product.all');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');
