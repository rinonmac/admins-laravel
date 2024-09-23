<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [HomeController::class, 'login']);
Route::get('/home', [HomeController::class, 'home']);
