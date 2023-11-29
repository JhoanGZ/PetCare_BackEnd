<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //Register user
    public function register(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'user_dni' => 'required|min:5|string',
            'username' => 'required|min:3|max:20|string',
            'name' => 'required|min:2|max:60|string',
            'last_name' => 'required|min:3|max:30|string',
            'birthdate' => 'required|date_format:Y-m-d',
            'address' => 'required|min:3|max:30|string',
            'phone_number' => 'required|max:30|string',
            'email' => 'required|email|min:4|unique:users,email',
            'image' => 'string',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'user_dni' => $attrs['user_dni'],
            'username' => $attrs['username'],
            'name' => $attrs['name'],
            'last_name' => $attrs['last_name'],
            'birthdate' => $attrs['birthdate'],
            'address' => $attrs['address'],
            'phone_number' => $attrs['phone_number'],
            'email' => $attrs['email'],
            'image' => $attrs['image'],
            'account_status' => '1',
            'account_credential' => '1',
            'password' => bcrypt($attrs['password']),
            //


        ]);

        // Crear el token de API asociado al usuario
        $token = $user->createToken('secret')->plainTextToken;

        // Asignar el token al usuario
        $user->api_token = $token;
        $user->save();

        //return user & token in response
        return response([
            'user' => $user,
            'api_token' => $token,
        ], 200);
    }

    // login user
    public function login(Request $request)
    {
        // Validar campos
        $attrs = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Intentar iniciar sesión
        if (!Auth::attempt($attrs)) {
            return response([
                'message' => 'Invalid credentials.'
            ], 403);
        }
    
        // Obtener el usuario autenticado
        $user = auth()->user();
    
        // Sobrescribir la api_token
        $user->api_token = $user->createToken('secret')->plainTextToken;
        $user->save();
    
        // Devolver la respuesta
        return response([
            'name' => $user->name,
            'token' => $user->api_token,
            'auth' => true,
        ], 200);
    }
    

    //logout user
public function logout()
{
    $user = auth()->user();
    $user->api_token = null; // O cualquier valor predeterminado que desees
    $user->save();

    return response([
        'message' => 'Logout success.'
    ], 200);
}



    //get user details
    public function user()
    {
        return response(['user' => auth()->user()], 200);
    }
}
