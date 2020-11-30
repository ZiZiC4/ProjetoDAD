<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users',[UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/products',[ProductController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);
//desta forma só quem está autenticado pode invocar o logout
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

//USERS
Route:: middleware('auth:sanctum')->get('users/me', [UserController::class, 'me']);
