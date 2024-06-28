<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('jwt.auth')->get('/users', [UsersController::class, 'users']);
// Route::middleware('jwt.auth')->get('/users', [UsersController::class, 'users']);
