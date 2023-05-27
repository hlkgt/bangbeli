<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'newUser'])->name('register.account');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.account');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [ProfileController::class, 'postProfile'])->name('post.profile');
    Route::patch('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::delete('/dashboard/profile', [AuthController::class, 'deleteProfile'])->name('delete.profile');

    Route::get('/dashboard/product', [DashboardController::class, 'product'])->name('dashboard.product');
    Route::post('/dahsboard/product/add-cart', [ProductController::class, 'addCart'])->name('add-cart');

    Route::get('/dashboard/testimoni', [DashboardController::class, 'testimoni'])->name('dashboard.testimoni');
    Route::get('/dashboard/cart', [DashboardController::class, 'cart'])->name('dashboard.cart');
    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');
});
