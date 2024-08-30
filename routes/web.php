<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

//Route::get('/panel/dashboard', function () {
//    return view('Admin.Pages.Dashboard.DashboardPage');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'DashboardIndex'])->name('dashboard');

});



require __DIR__.'/auth.php';
