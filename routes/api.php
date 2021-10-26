<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthController;


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


Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::group([
    'prefix' => 'auth'
], function () {
     Route::post('login', 'Auth\AuthController@login')->name('login');
     Route::post('register', 'Auth\AuthController@register');
     Route::group([
        'middleware' => 'auth:api'
      ], function() {
          Route::get('logout', 'Auth\AuthController@logout');
          Route::get('user', 'Auth\AuthController@user');
   });
});
*/

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::get('items', [ItemController::class, 'index'])->middleware('auth:api');
Route::get('items/{item}', [ItemController::class, 'read']);
Route::post('items', [ItemController::class, 'create']);
Route::put('items/{item}', [ItemController::class, 'update']);
Route::delete('items/{item}', [ItemController::class, 'delete']);

Route::get('orders/{order}/packages', [PackageController::class, 'index']);
Route::get('orders/{order}/packages/{package}', [PackageController::class, 'read']);
Route::post('orders/{order}/packages', [PackageController::class, 'create']);
Route::put('orders/{order}/packages/{package}', [PackageController::class, 'update']);
Route::delete('orders/{order}/packages/{package}', [PackageController::class, 'delete']);

Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{order}/', [OrderController::class, 'read']);
Route::post('orders', [OrderController::class, 'create']);
Route::put('orders/{order}/', [OrderController::class, 'update']);
Route::delete('orders/{order}/', [OrderController::class, 'delete']);

Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});
