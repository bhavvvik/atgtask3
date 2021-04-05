<?php

// use App\Http\Controllers\UserController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[UserController::class,'index']);
Route::get('register',[UserController::class,'index1']);

Route::post('User/auth',[UserController::class,'auth'])->name('user.auth'); 
Route::post('regauth',[UserController::class,'store'])->name('regauth'); 

Route::middleware(['user_auth'])->group(function() {
    Route::get('user/dashboard',[UserController::class,'dashboard']);
    // Route::get('user/logout', function () {
    //     session()->forget('USER_ID');
    //     session()->flash('error','Logout succesfully.');
    //     return redirect('login');
    
    //     });
    Route::get('user/logout',[UserController::class,'logout']);
});


