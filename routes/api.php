<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('task-list', [TaskController::class, 'taskIndex']);
    Route::post('task-entry', [TaskController::class, 'taskEntry']);
    Route::get('task-edit/{id}', [TaskController::class, 'taskEdit']);
    Route::post('task-update/{id}', [TaskController::class, 'taskUpdate']);
});
