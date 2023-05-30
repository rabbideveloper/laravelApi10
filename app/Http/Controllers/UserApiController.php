<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserApiController extends Controller
{
    public function showUser($id=null)
    {
        if ($id=='') {
            $users = User::get();
            return response()->json(['users' => $users],200);
        }else {
            $user = User::find($id);
            return response()->json(['user' => $user],200);
        }
    }


    public function addUser(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:20'
            ];

            $customMessage = [
                'name.required' => 'Name field is required',
                'email.required' => 'Email field is required',
                'email.email' => "The email must be a valid email!!",
                'password.required' => 'Password field is required',
            ];

            // $validator = validator($data,$rules,$customMessage);
            $validator = Validator::make($data,$rules,$customMessage);

            if($validator->fails()) {
                return response()->json($validator->errors(),422);
            }


            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            $message = "User Successfully Added";
            return response()->json(['message' => $message],201);
        }

    }
    // Post api for add multiple users
    public function addMultipleUser(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'users.*.name' => 'required|string',
                'users.*.email' => 'required|email|unique:users',
                'users.*.password' => 'required|min:6|max:20',
            ];

            $customMessage = [
                'users.*.name.required' => 'Name field is required',
                'users.*.email.required' => 'Email field is required',
                'users.*.email.email' => "The email must be a valid email!!",
                'users.*.password.required' => 'Password field is required',
            ];

            $validator = validator($data,$rules,$customMessage);
            if ($validator->fails()) {
                return response()->json($validator->errors(),422);
            }

            foreach ($data['users'] as $addUser) {
                $user = new User;
                $user->name = $addUser['name'];
                $user->email = $addUser['email'];
                $user->password = $addUser['password'];
                $user->save();
                $customMessage = "User Added Successfully";
            }

            return response()->json(['message' => $customMessage],201);

        }
    }
}
