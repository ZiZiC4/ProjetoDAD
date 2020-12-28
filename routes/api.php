<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
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





  //admin
  Route::middleware('auth:api')->delete('users/destroy/{id}', 'AdminController@destroy');
  Route::middleware('auth:api')->put('users/activate/{id}', 'AdminController@activateUser');

//Route::get('/users',[UserController::class, 'index']);
Route::get('/cookDashboard');
Route::get('/customerShopCart');


//USERS
Route::middleware('auth:sanctum')->get('users/me', [UserController::class, 'me']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::post('users/newAccount', [UserController::class, 'store']);
Route::post('users/newEmployee', [UserController::class, 'store']);
//Route::middleware('auth:sanctum')->post('users/managerRegister', [UserController::class, 'storeEmployee']);
Route::put('users/{user}',  [UserController::class, 'update']);
//Route::delete('users/{user}',  [UserController::class, 'delete']);
Route::post('users/filter', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->put('users/{id}', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('users/destroy/{id}', [UserController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('users/blocked/{id}', [UserController::class, 'blockedUser']);
Route::middleware('auth:sacntum')->patch('users/ProfilewithPass', [UserController::class, 'updateProfilewithPass']);
Route::middleware('auth:sanctum')->patch('users/ProfilewithoutPass', [UserController::class, 'updateProfilewithoutPass']);
Route::middleware('auth:sacntum')->get('users/profile', [UserController::class, 'profileRefresh']);

//PRODUCTS
Route::get('/products',[ProductController::class, 'index']);


//ORDERS
Route::get('orders',[OrderController::class,'getOrder']);
Route::post('orders',[OrderController::class,'createOrder']);
