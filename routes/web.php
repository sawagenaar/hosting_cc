<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\NewsMessageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::name('user.')->prefix('user')->group(function () {
    Route::get('index', [HomeController::class, 'index'])->name('home');
});

Route::name('admin.')->prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('index', AdminController::class)->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/subcategories', SubCategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/news', NewsMessageController::class);
    Route::resource('/discounts', DiscountController::class);
});

Route::name('superadmin.')->prefix('superadmin')->middleware('auth', 'superadmin')->group(function () {
    Route::resource('/admin', SuperadminController::class);
});


Route::get('/', [CatalogController::class, 'main'])->name('/');
Route::get('pages.category', [CatalogController::class, 'category'])->name('pages.category');
Route::get('pages.subcategory/{slug}', [CatalogController::class, 'subcategory'])->name('pages.subcategory');
Route::get('pages.product/{slug}', [CatalogController::class, 'product'])->name('pages.product');
Route::get('pages.discount', [CatalogController::class, 'discount'])->name('pages.discount');
Route::get('pages.search', [CatalogController::class, 'search'])->name('pages.search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{slug}', [CartController::class, 'store'])->name('cart');
Route::post('/cart/plus/{id}', [CartController::class, 'plus'])->name('cart.plus');
Route::post('/cart/minus/{id}', [CartController::class, 'minus'])->name('cart.minus');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cart/profile', [CheckoutController::class, 'profile'])->name('cart.profile')->middleware('auth');
Route::post('/cart/delivery/order', [CheckoutController::class, 'delivery'])->name('cart.delivery')->middleware('auth');
Route::post('/cart/make/{id}', [CheckoutController::class, 'make'])->name('cart.make')->middleware('auth');
Route::get('/cart/orders', [CheckoutController::class, 'orders'])->name('cart.orders')->middleware('auth');
Route::get('/cart/order/{id}', [CheckoutController::class, 'order'])->name('cart.order')->middleware('auth');
