<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Carbon\Carbon;
use JWTAuth;

class AuthController extends Controller
{
    /*inicia sesión y devuelve token*/
    public function login(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'email'              => 'required|email',
                'password'           => 'required',
            ],[
                'email.required'     => 'El email es requerido',
                'email.email'        => 'El email debe de tener un formato ejemplo@ejemplo.com',
                'password.required'  => 'La contraseña es requerida',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $element= User::where('email',$request->get('email'))->first();
            if(is_null($element)){
                return response()->json(['message'=>'Usuario no registrado. Por favor, revise las credenciales.'],404);
            }
            $credentials = $request->only('email', 'password');
            $exp= Carbon::now()->addDays(15)->timestamp;
            $token=JWTAuth::attempt($credentials, ['exp' => $exp]);
			if (!$token || is_null($token)) {
				return response()->json(['error' => 'Usuario o contraseña Incorrectos'], 400);
			}
            return response()->json([
                "data"=>[
                    "token"=>$token,
                    "user"=>JWTAuth::user(),
                    "exp"=>$exp,
                    "message"=> "Inicio de sesión exitoso"
                ]
            ],200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }        
    }
}