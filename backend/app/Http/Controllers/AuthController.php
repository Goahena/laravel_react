<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Bcrypt;


class AuthController extends BaseController
{
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'c_password' => 'required|string|same:password',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = new User;
        $user->username = $input['username'];
        $user->password = $input['password'];
        $user->fullname = $input['fullname'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->slug = Str::slug($input['fullname']);
        $user->status = $input['status'] ?? 1; // 1: active, 0: inactive
        $user->role_id = 1;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('public/img', $filename);
            $user->avatar = substr($path, strlen('public/'));
        }
        $user->save();
        $success['user'] = $user;
        return $this->sendResponse($success, 'User created successfully');
    }
    public function login(){
        $credetials = request([
            'username',
            'password'
        ]);

        if(! $token = JWTAuth::attempt($credetials)){
            return $this->sendError('Unauthorised', ['error' => 'Unauthorized'], 401);
        }
        $success = $this->respondWithToken($token);
        return $this->sendResponse($success, 'Logged in successfully');
    }
    public function logout(){
        $success = JWTAuth::invalidate(JWTAuth::getToken());
        return $this->sendResponse($success, 'Logout in successfully');
    }
    public function refresh(){
        $success = $this->respondWithToken(JWTAuth::parseToken()->refresh());
        return $this->sendResponse($success, 'Logged in successfully');
    }
    public function profile(){
        $success = JWTAuth::user(); // get the authenticated user
        return $this->sendResponse($success, 'Profile retrieved successfully');
    }

    public function respondWithToken($token){
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }

    // Gửi email reset password
    public function forgotPassword(Request $request)
    {
        
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email.'])
            : response()->json(['message' => 'Unable to send reset link.'], 400);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|string|same:password',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'c_paassword', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Password reset successfully.'])
            : response()->json(['message' => 'Password reset failed.'], 400);
    }
}
