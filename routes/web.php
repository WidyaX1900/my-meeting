<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.layout');
})->middleware('auth');

Route::get('/test', function () {
    return view('test');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/save', [AuthController::class, 'save']);
});
