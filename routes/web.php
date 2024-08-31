<?php

use App\Http\Controllers\Admin\DashboardController;
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

});

require __DIR__.'/auth.php';
