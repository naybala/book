<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
Route::controller(BookController::class)
    ->prefix('books')
    ->group(function () {
        Route::get('/list','list');
    });