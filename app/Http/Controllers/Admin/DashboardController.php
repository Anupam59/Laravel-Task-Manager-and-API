<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function DashboardIndex(){
        $User = User::count();
        $Task = TaskModel::count();
        return view('Admin.Pages.Dashboard.DashboardPage',compact('User','Task'));
    }
}
