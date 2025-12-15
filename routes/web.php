<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Bisa diakses siapa saja) ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');
// Route untuk melihat detail produk (menggunakan Slug)



// --- AUTH ROUTES (Hanya untuk yang sudah Login) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/{order}/pay', [App\Http\Controllers\OrderController::class, 'pay'])->name('orders.pay');
    
    Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
    Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    // 1. DASHBOARD (Dengan middleware verified bawaan Breeze)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    
    // 3. SHOPPING CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');

    // 4. CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    
    // 5. USER PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- ADMIN ROUTES (Kelola Produk) ---
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    
    // PERBAIKAN: Redirect /admin ke /admin/products
    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    })->name('admin.dashboard');

    // List Produk
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    
    // Create (Tambah)
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');

    // Edit (Update)
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    
    // Delete (Hapus)
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
});


// --- LOAD AUTHENTICATION ROUTES (Login, Register, Logout) ---
require __DIR__.'/auth.php';