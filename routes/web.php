<?php
/* Web Controllers */
use App\Http\Controllers\Main\HomeController;

/* Admin Controllers */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::name('admin.')->group(function () {
    Route::get('adminpanel', [LoginController::class, 'index'])->name('login');
    Route::post('adminpanel', [LoginController::class, 'doLogin'])->name('login.form');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/email', [ProfileController::class, 'doChangeEmail'])->name('profile.email');
    Route::post('/profile/password', [ProfileController::class, 'doChangePassword'])->name('profile.password');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'doCategory'])->name('category.form');
    Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    Route::get('/product', [CategoryController::class, 'index'])->name('product');
    Route::post('/product', [CategoryController::class, 'doProduct'])->name('product.form');
    Route::delete('/product/{id}', [CategoryController::class, 'deleteProduct'])->name('product.delete');

});
