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
            'rut' => 'required|min:5|string',
            'email' => 'required|email|min:4|unique:users,email',
            'nombre' => 'required|min:2|max:60|string',
            'apellido' => 'required|min:3|max:30|string',
            'password' => 'required|min:6',
            'fnac' => 'required|date_format:Y-m-d',
            'direccion' => 'required|min:3|max:30|string',
            'sexo' => 'required|max:1|integer', //NOTE::LUIGUI::30-11-23:: El selec del front debe suministrar un int 0 o 1.
            'celular' => 'required|max:30|string',
            'imagen' => 'string',
            'codigoVerificacion' => 'string|max:5',
        ]);

        $user = User::create([
            'rut' => $attrs['rut'],
            'email' => $attrs['email'],
            'nombre' => $attrs['nombre'],
            'apellido' => $attrs['apellido'],
            'password' => bcrypt($attrs['password']),
            'fnac' => $attrs['fnac'],
            'direccion' => $attrs['direccion'],
            'sexo' => $attrs['sexo'],
            'celular' => $attrs['celular'],
            'imagen' => null,
            'codigoVerificacion' => null,
            'usuarioActivo' => '1',
            // TODO::LUIGUI::30-11-23:: Leer el ultimo comit, debo ajutar la base de datos a las variables nuevas con migrate y además probar con postman y luego probar que el login siga funcionando.


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
            'name' => $user->nombre,
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
