<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PackageController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('items', [ItemController::class, 'index']);
Route::get('items/{item}', [ItemController::class, 'read']);
Route::post('items', [ItemController::class, 'create']);
Route::put('items/{item}', [ItemController::class, 'update']);
Route::delete('items/{item}', [ItemController::class, 'delete']);

Route::get('packages', [PackageController::class, 'index']);
Route::get('packages/{package}', [PackageController::class, 'read']);
Route::post('packages', [PackageController::class, 'create']);
Route::put('packages/{package}', [PackageController::class, 'update']);
Route::delete('packages/{package}', [PackageController::class, 'delete']);
