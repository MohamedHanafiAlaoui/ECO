<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;

Route::get('/captcha/generate', [App\Http\Controllers\CaptchaController::class, 'generate'])->name('captcha.generate');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/{id}/review', [ReviewController::class, 'store'])->name('product.review.store')->middleware(['honeypot', 'throttle:10,1']);

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware(['honeypot', 'throttle:5,1']);
Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Products CRUD
        Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
        Route::get('/products/create', [AdminController::class, 'productCreate'])->name('admin.products.create');
        Route::post('/products/store', [AdminController::class, 'productStore'])->name('admin.products.store');
        Route::get('/products/{id}/edit', [AdminController::class, 'productEdit'])->name('admin.products.edit');
        Route::post('/products/{id}/update', [AdminController::class, 'productUpdate'])->name('admin.products.update');
        Route::post('/editor/upload', [AdminController::class, 'editorUpload'])->name('admin.editor.upload');
        Route::get('/products/{id}/update', function($id) {
            return redirect()->route('admin.products.edit', $id);
        });
        Route::get('/products/{id}/delete', [AdminController::class, 'productDelete'])->name('admin.products.delete');

        // Categories CRUD
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
        Route::post('/categories/store', [AdminController::class, 'categoryStore'])->name('admin.categories.store');
        Route::get('/categories/{id}/delete', [AdminController::class, 'categoryDelete'])->name('admin.categories.delete');

        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'settingsUpdate'])->name('admin.settings.update');

        Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');

        // Orders Management
        Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::post('/orders/{id}/status', [AdminController::class, 'orderUpdateStatus'])->name('admin.orders.status');
    });
});
