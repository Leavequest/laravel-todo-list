<?php

use Illuminate\Support\Facades\Route;


// Laravel template default welcome route
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('app');
});