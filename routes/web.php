<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiFastPrintController;
use App\Http\Controllers\ProdukController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/fetch-fastprint', [ApiFastPrintController::class, 'fetch']);

Route::resource('produk', ProdukController::class);


