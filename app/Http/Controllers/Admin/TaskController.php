<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class TaskController extends Controller
{
    public function TaskIndex(){
        $Task = TaskModel::join('users as creator_by', 'creator_by.id', '=', 'task.creator')
            ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'task.modifier')
            ->select(
                'creator_by.name as creator_by',
                'modifier_by.name as modifier_by',
                'task.*'
            )
            ->orderBy('task_id','asc')->paginate(10);
        return view('Admin/Pages/Task/TaskIndex',compact('Task'));
    }

    public function TaskCreate(){
        $AllUser = User::select('id','name')->get();
        return view('Admin/Pages/Task/TaskCreate',compact('AllUser'));
    }

    public function TaskEntry(Request $request){

        $validation = $request->validate([
            'task_title' => 'required',
            'task_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);

        $data =  array();
        $data['task_title'] = $request->task_title;
        $data['task_description'] = $request->task_description;
        $data['to_user_id'] = $request->to_user_id;
        $data['start_date'] = explode(" - ",$request->date_range)[0];
        $data['end_date'] = explode(" - ",$request->date_range)[1];

        $task_file =  $request->file('task_file');
        if ($task_file){
            $Extension = $task_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$task_file->getClientOriginalExtension();
                $Path = "Images/task/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $task_file->move($url, $ImageName);
                $data['task_file'] = $url_database;
            }else{
                $ImageName =time().".".$task_file->getClientOriginalExtension();
                $Path = "Images/task/image/";
                $ResizeImage = Image::make($task_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $data['task_file'] = $url_database;
            }
        }

        $data['status'] = 1;
        $data['creator'] = Auth::user()->id;
        $data['modifier'] = Auth::user()->id;
        $data['created_date'] = date("Y-m-d h:i:s");
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TaskModel::insert($data);
        if ($res){
            return back()->with('success_message','Task Add Successfully!');
        }else{
            return back()->with('error_message','Task Add Fail!');
        }
    }

    public function TaskEdit($id){
        $AllUser = User::select('id','name')->get();
        $Task = TaskModel::where('task_id',$id)->first();
        return view('Admin/Pages/Task/TaskUpdate',compact('Task','AllUser'));
    }

    public function TaskUpdate(Request $request, $id){
        $request->validate([
            'task_title' => 'required|unique:task,task_title,'. $id .',task_id',
            'task_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
        ]);
        $data =  array();
        $data['task_title'] = $request->task_title;
        $data['task_description'] = $request->task_description;

        $task_file =  $request->file('task_file');
        if ($task_file){
            $Extension = $task_file->getClientOriginalExtension();
            if ($Extension == "pdf"){
                $ImageName =time().".".$task_file->getClientOriginalExtension();
                $Path = "Images/notice/file/";
                $url = $Path;
                $url_database = "/".$Path.$ImageName;
                $task_file->move($url, $ImageName);
                $OldData = TaskModel::where('notice_id','=',$id)->select('task_file')->first();
                $OldImage = $OldData->task_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['task_file'] = $url_database;
                    }else{
                        $data['task_file'] = $url_database;
                    }
                }else{
                    $data['task_file'] = $url_database;
                }
            }else{
                $ImageName =time().".".$task_file->getClientOriginalExtension();
                $Path = "Images/notice/image/";
                $ResizeImage = Image::make($task_file)->resize(1000,500);
                $url = $Path.$ImageName;
                $url_database = "/".$Path.$ImageName;
                $ResizeImage ->save($url);
                $OldData = NoticeModel::where('notice_id','=',$id)->select('task_file')->first();
                $OldImage = $OldData->task_file;
                $OldImageUrl = substr($OldImage, 1);
                if ($OldImage){
                    if (file_exists($OldImageUrl)){
                        unlink($OldImageUrl);
                        $data['task_file'] = $url_database;
                    }else{
                        $data['task_file'] = $url_database;
                    }
                }else{
                    $data['task_file'] = $url_database;
                }
            }
        }

        $data['status'] = $request->status;
        $data['modifier'] = 1;
        $data['modified_date'] = date("Y-m-d h:i:s");
        $res = TaskModel::where('task_id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Task Update Successfully!');
        }else{
            return back()->with('error_message','Task Update Fail!');
        }
    }
}
