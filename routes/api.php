<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){

});
// Route::post('auth/register',[AuthController::class,'sendOtp']);
Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/verify',[AuthController::class,'verify']);


Route::post('auth/login',[AuthController::class,'login']);
