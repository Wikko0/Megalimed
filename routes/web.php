<?php
/* Web Controllers */
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\Main\RegisterController;
use App\Http\Controllers\Main\AccountController;
use App\Http\Controllers\Main\ShopController;
use App\Http\Controllers\Main\ProductController;
use App\Http\Controllers\Main\CartController;
use App\Http\Controllers\Main\ContactsController;

/* Admin Controllers */
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/login', [LoginController::class, 'loginUser'])->name('login');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('logout');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register');
Route::get('/contact', [ContactsController::class, 'index'])->name('contact');
Route::get('/about', [ContactsController::class, 'index'])->name('about');

Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::put('/account/update', [AccountController::class, 'updateProfile'])->name('profile.update');

Route::get('/account/favorites', [AccountController::class, 'favorites'])->name('favorites');
Route::get('/favorites/{id}', [AccountController::class, 'makeFavorites'])->name('make.favorites');
Route::get('/account/orders', [AccountController::class, 'updateProfile'])->name('orders');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{url}', [ShopController::class, 'categories'])->name('shop.categories');

Route::get('/product/{id}', [ProductController::class, 'index'])->name('product');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/product/{productId}', [ProductController::class, 'calculator'])->name('calculator');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::name('admin.')->group(function () {
    Route::get('adminpanel', [AdminLoginController::class, 'index'])->name('login');
    Route::post('adminpanel', [AdminLoginController::class, 'doLogin'])->name('login.form');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/email', [ProfileController::class, 'doChangeEmail'])->name('profile.email');
    Route::post('/profile/password', [ProfileController::class, 'doChangePassword'])->name('profile.password');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category', [CategoryController::class, 'doCategory'])->name('category.form');
    Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    Route::get('/product', [AdminProductController::class, 'index'])->name('product');
    Route::post('/product', [AdminProductController::class, 'doProduct'])->name('product.form');
    Route::delete('/product/{id}', [AdminProductController::class, 'deleteProduct'])->name('product.delete');
    Route::post('/product/status/{id}', [AdminProductController::class, 'statusProduct'])->name('product.status');

    Route::post('/upload/temp', [AdminProductController::class, 'uploadTempProduct'])->name('product.temp.upload');
    Route::delete('/delete/temp', [AdminProductController::class, 'deleteTempProduct'])->name('product.temp.delete');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'doSettings'])->name('settings.form');
});
