<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// regis
Route::post('/regis', [App\Http\Controllers\Api\RegisterController::class, 'store']);

// user
Route::get('/user', [App\Http\Controllers\UsersController::class,'index']);

// login
Route::post('/login', [App\Http\Controllers\Api\LoginController::class,'login']);




