<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\ListRevenues;
use App\Http\Controllers\RevenueController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CashierController;
use App\Http\Controllers\SalesReportController;


Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login']);
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/customer/register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('/customer/register', [CustomerRegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // ... route keranjang

    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/revenues/export', [RevenueController::class, 'export'])->name('revenues.export');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/customer/login/google', [CustomerAuthController::class, 'redirectToProvider'])->name('google.login');
Route::get('/customer/login/google/callback', [CustomerAuthController::class, 'handleGoogleCallback']);
Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
Route::post('/cashier/checkout', [CashierController::class, 'checkout'])->name('cashier.checkout');
Route::get('/products/search', [CashierController::class, 'search'])->name('products.search');
Route::get('/cashier/history', [CashierController::class, 'showHistory'])->name('cashier.history');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/products', [ProductController::class, 'showProducts'])->name('products.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');


Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/cashier/product-stats', [CashierController::class, 'showProductStats'])->name('cashier.product-stats');

Route::get('/sales-report', [SalesReportController::class, 'showDetailedSalesReport'])->name('cashier.sales_report');
Route::get('/sales-report/category', [SalesReportController::class, 'showSalesReportByCategory'])->name('sales_report_category');
