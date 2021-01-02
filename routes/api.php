<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CustomerController;
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

//admin
Route::middleware('auth:api')->delete('users/destroy/{id}', 'AdminController@destroy');
Route::middleware('auth:api')->put('users/activate/{id}', 'AdminController@activateUser');

//Route::get('/users',[UserController::class, 'index']);
Route::get('/cookDashboard');
Route::get('/customerShopCart');

Route::get('/productCreate');



//USERS
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::middleware('auth:sanctum')->get('users/me', [UserController::class, 'me']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::post('users/newAccount', [UserController::class, 'storeCustomer']);
Route::post('users/newEmployee', [UserController::class, 'store']);

//Route::middleware('auth:sanctum')->post('users/managerRegister', [UserController::class, 'storeEmployee']);
//Route::delete('users/{user}',  [UserController::class, 'delete']);
Route::post('users/filter', [UserController::class, 'index']);
Route::get('customer/perfil', [CustomerController::class, 'profile']);

Route::middleware('auth:sanctum')->get('users',                 [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('users/emailavailable',  [UserController::class, 'emailAvailable']);
Route::middleware('auth:sanctum')->get('users/{user}',          [UserController::class, 'show']);
Route::middleware('auth:sanctum')->put('users/{user}',          [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('users/{id}',       [UserController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('users/blocked/{id}', [UserController::class, 'blockUser']);
Route::middleware('auth:sacntum')->get('users/profile', [UserController::class, 'profileRefresh']);



Route::put('userManagement/deactivate/{id}', 'AdminController@deactivateUser');
Route::put('userManagement/activate/{id}', 'AdminController@activateUser');


Route::post('login', [AuthController::class, 'login']);
//desta forma só quem está autenticado pode invocar o logout
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->patch('users/ProfileWithPass', [UserController::class, 'updateProfileWithPass']);
Route::middleware('auth:sanctum')->patch('users/ProfileWithoutPass', [UserController::class, 'updateProfileWithoutPass']);
Route::put('cook/{user}',[UserController::class,'updateCookState']);
Route::put('delivery/{user}',[UserController::class,'updateDelState']);

//PRODUCTS
Route::get('/products',[ProductController::class, 'index']);
Route::post('/product/newProduct', [ProductController::class, 'storeProduct']);
Route::put('/products/{id}',[ProductController::class, 'updateProduct']);

//ORDERS
Route::post('/orders',[OrderController::class,'createOrder']);
Route::get('orders',[OrderController::class,'getOrder']);
Route::get('/delivery/orders',[OrderController::class,'getReadyOrders']);
Route::put('/delivery/orders/{order}',[OrderController::class,'deliverOrder']);
Route::put('/orders/{order}',[OrderController::class,'updateOrder']);
