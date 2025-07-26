<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/save', [AuthController::class, 'save']);
    Route::get('/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('layouts.layout');
    });
    
    Route::get('/test', function () {
        return view('test');
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
