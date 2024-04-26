<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
Route::controller(BookController::class)
    ->prefix('books')
    ->group(function () {
        Route::get('/','index');
        Route::post('/store','store');
        Route::post('/edit','show');
        Route::post('/update','update');
        Route::post('/delete','destroy');
    });