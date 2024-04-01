<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\VerificarEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required', 
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $client = Cliente::create([
            'user_id' => $user->id,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'id' => $user->id,
        ]);

        
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
  
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        //return $user->tecnico;
        $role = "";
        if ($user->tecnico != NULL) {
            $role="Tecnico";
        } else if ($user->cliente != NULL) {
            $role="Cliente";
        }
        return response()->json([
            'rol' => $role,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
        
    }
  
    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * 
     * Metodo que envia el email de verificacion 
     */
    public function verificarEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email ya existe'], 400);
        }

        $code = rand(100000, 999999);
        Mail::to($request->email)->send(new VerificarEmail($code));

        return response()->json([
            'message' => 'Email enviado correctamente',
            'code' => $code
        ], 200);

    }
    
}