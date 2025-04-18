<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;


Route::post('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::post('/login', [AuthController::class ,'login'])->name('login');
Route::post('/register', [AuthController::class,  'register'])->name('register');