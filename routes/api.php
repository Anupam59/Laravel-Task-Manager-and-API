<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function (){
    Route::post('register','Register');
    Route::post('login','Login');

    Route::get('user','userProfile')->middleware('auth:sanctum');
    Route::get('logout','userLoggedOut')->middleware('auth:sanctum');
});
