<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['accept.json']],function(){
    require __DIR__."/BookApi/bookApi.php";
});
