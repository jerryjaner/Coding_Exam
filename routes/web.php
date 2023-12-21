<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
    

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



Route::get('/', function () { return view('welcome'); });
Route::post('/create_product', [ProductController::class, 'create_product'])->name('create_product');
Route::get('/get-allproduct', [ProductController::class, 'fetch_all'])->name('get_product');
Route::get('/edit-product', [ProductController::class, 'edit_product'])->name('edit_product');
Route::post('/update-product', [ProductController::class, 'update_product'])->name('update_product');
Route::delete('/delete', [ProductController::class, 'delete_product'])->name('delete');