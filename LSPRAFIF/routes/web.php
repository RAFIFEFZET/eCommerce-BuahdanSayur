<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.home');
});

// Template Master
Route::resource('/', 'App\Http\Controllers\DashboardController');
Route::resource('admin', 'App\Http\Controllers\AdminController');
// ============================================================================

// Shops View
Route::resource('carts', 'App\Http\Controllers\CartsController');
Route::put('/carts/{id}/updateCart', 'CartsController@updateCart')->name('carts.updateCart');
Route::get('/shopdetail/{id}', 'App\Http\Controllers\DashboardController@productDetail')->name('shopdetail.index');
// RajaOngkir routes
use App\Http\Controllers\CheckoutController;

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('get-city', [CheckoutController::class, 'getCity'])->name('checkout.getCity');
    Route::get('get-shipping-cost', [CheckoutController::class, 'getShippingCost'])->name('checkout.getShippingCost');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
});

// ============================================================================


// View Master(admin)
Route::middleware(['admin.auth'])->group(function () {
    Route::resource('product_categories', 'App\Http\Controllers\ProductCategoriesController');
    Route::resource('products', 'App\Http\Controllers\ProductsController');
    Route::resource('orders', 'App\Http\Controllers\OrdersController');
    Route::resource('order_details', 'App\Http\Controllers\OrderDetailsController');
    Route::resource('customers', 'App\Http\Controllers\CustomersController');
    Route::resource('payments', 'App\Http\Controllers\PaymentsController');
    Route::resource('discounts-admin', 'App\Http\Controllers\DiscountsController');
    Route::resource('deliveries', 'App\Http\Controllers\DeliveriesController');
    Route::resource('product_reviews-admin', 'App\Http\Controllers\ProductReviewsController');
});

// ================================================================================================

// Auth
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showUserRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register.post');
Route::get('/admin-login', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin-login', 'App\Http\Controllers\Auth\LoginController@adminLogin')->name('admin.login.post');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();
// ===================================================================================================================

Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
Route::put('/profile/update', 'App\Http\Controllers\ProfileController@update')->name('profile.update');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');


