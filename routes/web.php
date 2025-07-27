<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingRoomController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/save', [AuthController::class, 'save']);
    Route::get('/login', [AuthController::class, 'login_form'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function() {    
    Route::get('/test', function () {
        return view('test');
    });    
    
    Route::post('/logout', [AuthController::class, 'logout']);    
    
    // Meeting Route
    Route::get('/', [MeetingRoomController::class, 'index']);
    Route::post('/meeting_room/store', [MeetingRoomController::class, 'store']);
    Route::get('/meeting', [MeetingController::class, 'index']);
    Route::get('/meeting/join/{token}', [MeetingController::class, 'join']);
    Route::post('/meeting/save_peer', [MeetingController::class, 'save_peer']);
});
