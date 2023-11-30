<?php

use App\Http\Controllers\GetProductFromAPI;
use App\Livewire\Categories\Category;
use App\Livewire\Counter;
use App\Livewire\Produk;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Produk::class);

Route::get('/counter', Counter::class);
Route::get('/categories', Category::class);
Route::get('/get-product', [GetProductFromAPI::class, 'index']);
