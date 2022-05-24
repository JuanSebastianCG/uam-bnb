<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PropertyController;
use App\Http\Controllers\api\v1\BillController;
use App\Http\Controllers\api\v1\Rental_availabilityController;
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



Route::apiResource('v1/property', PropertyController::class);


Route::post('/v1/login',[App\Http\Controllers\api\v1\AuthController::class,'login'])->name('api.login');
Route::middleware(['auth:sanctum'])->group(function() {

    Route::post('/v1/logout',[App\Http\Controllers\api\v1\AuthController::class,'logout'])->name('api.logout');
    
    Route::get('v1/user', [App\Http\Controllers\api\v1\UserController::class,'index']);
    Route::put('v1/user', [App\Http\Controllers\api\v1\UserController::class,'update']);
    Route::delete('v1/user', [App\Http\Controllers\api\v1\UserController::class,'destroy']);

    Route::apiResource('v1/bills', BillController::class);

    Route::apiResource('v1/rentals', Rental_availabilityController::class);
    Route::get('v1/rentals/property/{property}', [App\Http\Controllers\api\v1\Rental_availabilityController::class,'showOfProperty']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
