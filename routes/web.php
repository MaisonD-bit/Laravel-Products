<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;


Route::get('/', function () {
    return redirect(route('products')); 
});

Route::resource('products', ProductController::class);
Route::get('files/upload', [FileController::class, 'upload'])->name('products.upload');
Route::post('files/upload', [FileController::class, 'storeToStorage'])->name('products.storeFile');

