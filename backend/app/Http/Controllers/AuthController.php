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
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


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
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('public/img', $filename);
            $user->image = substr($path, strlen('public/'));
        }
        $user->save();
        $success['user'] = $user;
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
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
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        // Tạo mã xác minh 6 số
        $verificationCode = random_int(100000, 999999);

        // Lưu mã xác minh vào cơ sở dữ liệu
        $user->verification_code = $verificationCode;
        $user->code_expires_at = Carbon::now()->addMinutes(10); // Hết hạn sau 10 phút
        $user->save();

        // Gửi email
        Mail::raw("Your verification code is: $verificationCode", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Verification Code');
        });

        return response()->json(['message' => 'Verification code sent.']);
    }
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6',
            'password' => 'required|min:6',
            'c_password' => 'required|string|same:password',
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->verification_code)
                    ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid code.'], 400);
        }

        if (Carbon::now()->greaterThan($user->code_expires_at)) {
            return response()->json(['message' => 'Code expired.'], 400);
        }

        // Xác minh thành công
        $user->verification_code = null; // Xóa mã để tránh sử dụng lại
        $user->code_expires_at = null;
        $user->password = bcrypt($request->password); // Mật khẩu đã được xác minh
        $user->save();

        return response()->json(['message' => 'Verification successful.']);
    }
}
