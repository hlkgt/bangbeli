<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimoniController;

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
    return redirect()->route('login');
})->name('welcome')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'newUser'])->name('register.account')->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.account')->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('/dashboard/profile', [ProfileController::class, 'postProfile'])->name('post.profile');
    Route::patch('/dashboard/profile', [ProfileController::class, 'updateProfile'])->name('update.profile');
    Route::delete('/dashboard/profile', [AuthController::class, 'deleteProfile'])->name('delete.profile');

    Route::get('/dashboard/product', [DashboardController::class, 'product'])->name('dashboard.product');
    Route::get('/dashboard/product/update-view', [ProductController::class, 'showUpdateView'])->name('view.update.product');
    Route::post('/dashboard/product/update', [ProductController::class, 'updateProduct'])->name('update.product');

    Route::post('/dashboard/product/payment', [PaymentController::class, 'payment'])->name('payment');

    Route::get('/dashboard/testimoni', [DashboardController::class, 'testimoni'])->name('dashboard.testimoni');
    Route::get('/dashboard/create-testimoni', [DashboardController::class, 'showTestimoni'])->name('show.create.testimoni');
    Route::get('/dashboard/ulasan-saya', [DashboardController::class, 'myTestimoni'])->name('my.testimoni');
    Route::post('/dashboard/create-testimoni', [TestimoniController::class, 'createTestimoni'])->name('create.testimoni');

    Route::get('/dashboard/history', [DashboardController::class, 'history'])->name('dashboard.history');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
