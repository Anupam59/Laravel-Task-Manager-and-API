<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

//Route::get('/panel/dashboard', function () {
//    return view('Admin.Pages.Dashboard.DashboardPage');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'DashboardIndex'])->name('dashboard');

    Route::get('/task-list', [TaskController::class, 'TaskIndex']);
    Route::get('/task-create', [TaskController::class, 'TaskCreate']);
    Route::post('/task-entry', [TaskController::class, 'TaskEntry']);
    Route::get('/task-edit/{id}', [TaskController::class, 'TaskEdit']);
    Route::post('/task-update/{id}', [TaskController::class, 'TaskUpdate']);
    Route::post('/task-delete', [TaskController::class, 'TaskDelete']);

    Route::get('/profile', [ProfileController::class, 'ProfileIndex']);
    Route::get('/profile-password-update', [ProfileController::class, 'PasswordUpdatePage']);
    Route::get('/profile-edit/{id}', [ProfileController::class, 'ProfileEdit']);
    Route::post('/profile-update/{id}', [ProfileController::class, 'ProfileUpdate']);

    Route::post('/update-user-password/{id}', [ProfileController::class, 'PasswordUpdate']);

});

require __DIR__.'/auth.php';
