<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;


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

Route::post("regauth",[UserController::class,'store']);
Route::post("loginauth",[UserController::class,'auth']);

Route::post("auth", "UserController@auth");

// Route::group(['middleware' => 'user_auth'], function () {
//     // Route::get("user-detail", "UserController@userDetail");
//     Route::get("ud", [UserController::class,'userDetail']);

// });
Route::middleware(['auth:api'])->group(function() {
    Route::get("ud", [UserController::class,'userDetail']);

    Route::post("todo/add", [TaskController::class,'create']);
    Route::get("todo/tasks", [TaskController::class,'tasks']);
    Route::get("todo/task/{task_id}", [TaskController::class,'task']);
    Route::post("todo/status/{task_id}", [TaskController::class,'change']);


    

});