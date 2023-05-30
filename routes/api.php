<?php

use App\Http\Controllers\UserApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get api for show users
Route::get('users/{id?}',[UserApiController::class,'showUser']);

// Post api for add-user
Route::post('add-user',[UserApiController::class,'addUser']);

// Post api for add multiple users
Route::post('add-multiple-user',[UserApiController::class,'addMultipleUser']);

