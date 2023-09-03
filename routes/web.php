<?php
/* Web Controllers */
use App\Http\Controllers\Main\HomeController;

/* Admin Controllers */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('login.form');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
