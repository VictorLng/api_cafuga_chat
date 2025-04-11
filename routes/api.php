<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialAuthController;


Route::post('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});
