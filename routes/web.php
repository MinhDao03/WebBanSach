<?php

use App\Http\Controllers\{
    WelcomeController, 
    AuthController, 
    AdminController, 
    ProductController, 
    CategoryController, 
    UserController,
    CartController,
};
use App\Http\Controllers\Admin\OrderController;  
use App\Http\Controllers\Admin\ReportController;


// Route chính
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Đăng ký và đăng nhập người dùng
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// Định nghĩa các route cho admin với prefix là 'admin' 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Định nghĩa resource cho danh mục
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy',
    ]);

    // Định nghĩa resource cho sản phẩm
    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'show' => 'products.show',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Route quản lý đơn hàng 
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    // Route quản lý báo cáo
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// Route cho người dùng bình thường (không phải admin)
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard')->middleware('auth');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Route cho giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

// Route cho đơn hàng của người dùng bình thường 
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
