<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $this->sendResponse($users, 'Users retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255|unique:users',
            'role_id' => 'required|integer',
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
        $user->role_id = $input['role_id']; 
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            $path = $file->storeAs('public/img', $filename);
            $user->image = substr($path, strlen('public/'));
        }
        $user->save(); 
        $success['user'] = $user; 
        return $this->sendResponse($success, 'User created successfully'); 
        
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
         if (!$user) {
             return $this->sendError('User not found', [], 404);
         }
         return $this->sendResponse($user, 'User retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->first();
         if (!$user) {
             return $this->sendError('User not found', [], 404);
         }
         $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'required|string|min:6',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $user->id,
            'role_id' => 'required|integer',
            ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user->username = $input['username'];
        $user->password = $input['password'];
        $user->fullname = $input['fullname'];
        $user->email = $input['email'];
        $user->phone = $input['phone'];
        $user->slug = Str::slug($input['fullname']); 
        $user->status = $input['status'] ?? 1; // 1: active, 0: inactive 
        $user->role_id = $input['role_id']; 
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::delete('public/' . $user->image);
            $path = $file->storeAs('public/img', $filename);
            $user->image = substr($path, strlen('public/'));
        }
        $user->save(); 
        $success['user'] = $user; 
        return $this->sendResponse($success, 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($slug)
    {
        $user = User::where('slug', $slug)->first();

        if (!$user) {
            return $this->sendError('User not found');
        }

        // Xóa image nếu có
        if ($user->image) {
            Storage::delete('public/' . $user->image);
        }

        $user->delete();

        return $this->sendResponse([], 'User deleted successfully');
    }
}
