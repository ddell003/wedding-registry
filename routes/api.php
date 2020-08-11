<?php

use App\Http\Api\MealController;
use App\Http\Api\PartyController;
use App\Http\Api\RegistryItemController;
use Illuminate\Http\Request;

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

Route::group(['middleware' => ['throttle:20,1', 'auth:api']], function () {

    Route::resource('/party', '\\' . PartyController::class);
    Route::resource('/meal', '\\' . MealController::class);
    Route::resource('/registry_items', '\\' . RegistryItemController::class);

});

//Route::resource('users', '\\' . UserController::class);
