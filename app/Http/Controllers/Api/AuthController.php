<?php

namespace App\Http\Controllers\Api;
use App\Helper\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function Register(ResisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            if ($user){
                return ResponseHelper::success(message: 'User has been registered successfully', data: $user, statusCode: 201);
            }else{
                return ResponseHelper::error(message: 'Unable to Register user: Please try again.', statusCode: 400);
            }

        }catch (Exception $exception){
            Log::error('Unable to Register user:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Register user: Please try again.', statusCode: 400);
        }
    }

    public function Login(LoginRequest $request)
    {
        try {
            if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return ResponseHelper::error(message: 'Unable to Login due to invalid credential.', statusCode: 400);
            }
            $user = Auth::user();
            //API Token Create
            $token = $user->createtoken('My Api Token')->plainTextToken;
            $authUser = [
                'user' => $user,
                'token' => $token
            ];
            return ResponseHelper::success(message: 'User has been Login successfully', data: $authUser, statusCode: 200);

        }catch (Exception $exception){
            Log::error('Unable to Login user:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to Login user: Please try again.', statusCode: 400);
        }
    }

    public function userProfile(){
        try {
            $user = Auth::user();
            if ($user){
                return ResponseHelper::success(message: 'User Profile fetched successfully', data: $user, statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Unable to User Profile: Please try again.', statusCode: 400);
            }
        }catch (Exception $exception){
            Log::error('Unable to User Profile:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to User Profile: Please try again.', statusCode: 400);
        }
    }

    public function userLoggedOut(){
        try {
            $user = Auth::user();
            if ($user){
                $user->currentAccessToken()->delete();
                return ResponseHelper::success(message: 'User Logged out successfully', statusCode: 200);
            }else{
                return ResponseHelper::error(message: 'Unable to User Logged out: Please try again.', statusCode: 400);
            }
        }catch (Exception $exception){
            Log::error('Unable to User Logout:' . $exception->getMessage() .' - Line no. ' . $exception->getLine());
            return ResponseHelper::error(message: 'Unable to User Logout: Please try again.'. $exception->getMessage(), statusCode: 400);
        }
    }

}
