<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\web\ProductsController;

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

Auth::routes();

Route::get('/', [ProductsController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');
