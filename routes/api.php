<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Model\User;
use Illuminate\Support\Facades\Hash;

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


// Route::patch('users/ProfilewithPass', 'UserController@updateProfilewithPass');
// Route::patch('users/ProfilewithoutPass', 'UserController@updateProfilewithoutPass');
// Route::put('users/{id}', 'UserController@update');  

/*
Route::middleware('auth:api')->get('users', 'UserController@index');
Route::post('users/newAccount', 'UserController@store');
Route::middleware('auth:api')->post('users/OperatorAdmin', 'UserController@storeOperatorAdmin'); 
Route::post('users/filter', 'UserController@index'); 
Route::middleware('auth:api')->put('users/{id}', 'UserController@update');  
Route::middleware('auth:api')->delete('users/destroy/{id}', 'UserController@destroy');
Route::middleware('auth:api')->put('users/activate/{id}', 'UserController@activateUser');
Route::middleware('auth:api')->get('users/profile', 'UserController@profileRefresh');
Route::middleware('auth:api')->get('users/statsInative', 'UserController@getAllUsersInatives');
*/

Route::get('/cookDashboard');
Route::get('/users',[UserController::class, 'index'])->middleware('manager');
Route::post('users/newAccount', [UserController::class, 'store']);
Route::get('/products',[ProductController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
//desta forma só quem está autenticado pode invocar o logout
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);




//USERS
Route:: middleware('auth:sanctum')->get('users/me', [UserController::class, 'me']);
Route::put('users/{user}',  [UserController::class, 'update']);
Route::delete('users/{user}',  [UserController::class, 'delete']);

