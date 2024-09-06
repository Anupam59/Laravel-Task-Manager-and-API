<?php

namespace App\Http\Controllers\Api;

use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\TaskModel;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Laravel\Facades\Image;

class TaskController extends Controller
{


    public function taskIndex(){
        try {
            $Task = TaskModel::join('users as creator_by', 'creator_by.id', '=', 'task.creator')
                ->leftJoin('users as modifier_by', 'modifier_by.id', '=', 'task.modifier')
                ->select(
                    'creator_by.name as creator_by',
                    'modifier_by.name as modifier_by',
                    'task.*'
                )->orderBy('created_date','desc')->get();
            if ($Task){
                return ResponseHelper::success(message: 'Task All Data Get!', data: $Task, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Task All Data Get Fail: Please try again.', statusCode: 400);
            }

        }catch (Exception $exception){
            Log::error('Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine(), statusCode: 400);
        }

    }



    public function taskEntry(Request $request)
    {
        try {
            date_default_timezone_set("Asia/Dhaka");
            $validation = $request->validate([
                'task_title' => 'required',
                'task_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
                'to_user_id' => 'required',
            ]);
            $data =  array();
            $data['task_title'] = $request->task_title;
            $data['task_description'] = $request->task_description;
            $data['to_user_id'] = $request->to_user_id;
            $data['start_date'] = $request->start_date;;
            $data['end_date'] = $request->end_date;;

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
                    $ResizeImage = Image::read($task_file)->resize(1000,500);
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
                return ResponseHelper::success(message: 'Task Add Successfully!', data: $res, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Task Add Fail: Please try again.', statusCode: 400);
            }
        }catch (Exception $exception){
            Log::error('Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine(), statusCode: 400);
        }
    }


    public function taskEdit($id){
        try {
            $Task = TaskModel::where('task_id',$id)->first();
            if ($Task){
                return ResponseHelper::success(message: 'Task Show Successfully!', data: $Task, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Task not Show: Please try again.', statusCode: 400);
            }
        }catch (Exception $exception){
            Log::error('Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine(), statusCode: 400);
        }
    }



    public function taskUpdate(Request $request, $id){
        try {
            date_default_timezone_set("Asia/Dhaka");
            $request->validate([
                'task_title' => 'required|unique:task,task_title,'. $id .',task_id',
                'task_file' => 'mimes:jpeg,bmp,png,gif,svg,pdf|max:1024', //only 1MB is allowed
                'to_user_id' => 'required',
            ]);
            $data =  array();
            $data['task_title'] = $request->task_title;
            $data['task_description'] = $request->task_description;
            $data['to_user_id'] = $request->to_user_id;
            $data['start_date'] = $request->start_date;
            $data['end_date'] = $request->end_date;

            $task_file =  $request->file('task_file');
            if ($task_file){
                $Extension = $task_file->getClientOriginalExtension();
                if ($Extension == "pdf"){
                    $ImageName =time().".".$task_file->getClientOriginalExtension();
                    $Path = "Images/task/file/";
                    $url = $Path;
                    $url_database = "/".$Path.$ImageName;
                    $task_file->move($url, $ImageName);
                    $OldData = TaskModel::where('task_id','=',$id)->select('task_file')->first();
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
                    $Path = "Images/task/image/";
                    $ResizeImage = Image::read($task_file)->resize(1000,500);
                    $url = $Path.$ImageName;
                    $url_database = "/".$Path.$ImageName;
                    $ResizeImage ->save($url);
                    $OldData = TaskModel::where('task_id','=',$id)->select('task_file')->first();
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
            $data['modifier'] = Auth::user()->id;
            $data['modified_date'] = date("Y-m-d h:i:s");
            $res = TaskModel::where('task_id','=',$id)->update($data);
            if ($res){
                return ResponseHelper::success(message: 'Task Update Successfully!', data: $res, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Task Update Fail!: Please try again.', statusCode: 400);
            }
        }catch (Exception $exception){
            Log::error('Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine(), statusCode: 400);
        }
    }

    function taskDelete(Request $request){
        try {
            $task_id= $request->input('task_id');
            $OldData = TaskModel::where('task_id','=',$task_id)->select('task_file')->first();
            $OldImage = $OldData->task_file;
            $OldImageUrl = substr($OldImage, 1);
            if ($OldImage){
                if (file_exists($OldImageUrl)){
                    unlink($OldImageUrl);
                }
            }
            $res= TaskModel::where('task_id','=',$task_id)->delete();
            if ($res){
                return ResponseHelper::success(message: 'Task Delete Successfully!', data: $res, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Task Delete Fail!: Please try again.', statusCode: 400);
            }

        }catch (Exception $exception){
            Log::error('Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Task:' . $exception->getMessage() .' - Line no. ' . $exception->getLine(), statusCode: 400);
        }
    }
}
