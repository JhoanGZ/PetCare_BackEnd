<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request){
        //validate fields
        $attrs = $request->validate([
            'user_dni' => 'required|string',
            'username' => 'required|string',
            'name' => 'required|string',
            'last_name' => 'required|string',
            'birthdate' => 'required|date_format:Y-m-d',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'image' => 'string',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'user_dni'=>$attrs['user_dni'],
            'username'=>$attrs['username'],
            'name'=>$attrs['name'],
            'last_name'=>$attrs['last_name'],
            'birthdate'=>$attrs['birthdate'],
            'address'=>$attrs['address'],
            'phone_number'=>$attrs['phone_number'],
            'email'=>$attrs['email'],
            'image'=>$attrs['image'],
            'account_status'=> '1',
            'account_credential'=> '1',
            'password'=>bcrypt($attrs['password']),

        ]);

        //return user & token in response
        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken,
            ], 200);
        }

        // login user
        public function login(Request $request){
            //validate fields
            $attrs = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // attemp login
            if (!Auth::attempt($attrs)) {
                return response([
                    'message' => 'Invalid credentials.'
                ], 403);
            }
    
            //return user & token in response
            return response([
                'user' => auth()->user(),
                'token' => auth()->user()->createToken('secret')->plainTextToken,
            ], 200);
        }

        //logout user
        public function logout(){
            auth()->user()->tokens()->delete();
            return response([
                'message' => 'Logout success.'
            ], 200);
        }

        //get user details
        public function user(){
            //return response(['user' => Auth::user()], 200);
            return response(['user' => auth()->user()], 200);
        }
}
