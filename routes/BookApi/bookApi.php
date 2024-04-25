<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('books/',[BookController::class,'index']);
Route::post('books/store',[BookController::class,'store']);
Route::post('books/edit',[BookController::class,'show']);
Route::post('books/update',[BookController::class,'update']);
Route::post('books/delete',[BookController::class,'destroy']);