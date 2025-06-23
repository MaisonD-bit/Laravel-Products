<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SysUserController;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('login', [SysUserController::class, 'login'])->name('login');
Route::post('login', [SysUserController::class, 'authenticate'])->name('authenticate');

Route::get('register', [SysUserController::class, 'register'])->name('register');
Route::post('register', [SysUserController::class, 'store'])->name('store');

Route::post('logout', [SysUserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('files/upload', [FileController::class, 'upload'])->name('products.upload');
    Route::post('files/upload', [FileController::class, 'storeToStorage'])->name('products.storeFile');
});