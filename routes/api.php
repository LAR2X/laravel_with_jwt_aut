<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\testController;




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


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {

    
    Route::post('registers',[JWTAuthController::class,'register']);


    Route::post('login', [JWTAuthController::class,'login']);
    // Route::post('logout', [JWTAuthController::class,'logout']);
    Route::get('refresh', [JWTAuthController::class,'refresh']);
    // Route::get('profile', [JWTAuthController::class,'profile']);




});


Route::group([
    'middleware' => 'auth:api',
], function () {

    Route::get('test', [testController::class,'test']);
});









