<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rol;

class UserController extends Controller
{
    public function all(){
        try {
            $response = [
                'message'=> 'Lista de usuarios',
                'data' => User::all(),
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de obtener los datos.',
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ], 500);
        }
    }
    /*registro de elemento (user)*/
    public function store(Request $request){     
        try{
            $validator = Validator::make($request->all(), [
                'name'                           => 'required|string',
                'email'                          => 'required|string|email|unique:users',
                'password'                       => 'required|string|min:8|confirmed',
                'rol'                            => 'required',
            ],[
                'name.required'                  => 'El nombre es requerido',
                'name.string'                    => 'El nombre debe ser cadena de texto',
                'email.required'                 => 'El email es requerido',
                'email.string'                   => 'El email debe ser cadena de texto',
                'email.unique'                   => 'El email ya esta en uso',
                'email.email'                    => 'El email debe de tener un formato ejemplo@ejemplo.com',
                'password.required'              => 'La contraseña es requerida',
                'password.min'                   => 'La contraseña debe de tener minimo 8 caracteres',
                'password_confirmation.required' => 'La confirmación de la contraseña es requerida',
                'password.confirmed'             => 'Las contraseña no coinciden vuelva a intentar',
                'rol.required'                   => 'Debe seleccionar un rol',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $rol=$request->get('rol') && isset($request->get('rol')["id"]) && !is_null($request->get('rol')["id"])? Rol::find($request->get('rol')["id"]) : null;
            if(is_null($rol)){
                return response()->json(['message'=>'Rol no existente'],404);
            }
            $element = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')), 
                'id_rol' => $rol->id
            ]);
            return response()->json([
                'message'=> 'Usuario registrado satisfactoriamente',
                'data' => User::find($element->id) 
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ], 500);
        }
    }
    /*actualizacion de elemento (usuarios)*/
    public function update(Request $request,$id){        
        try {
            $validator = Validator::make($request->all(), [
                'name' =>  'required|string',
                'email' => 'required|email|max:45|unique:users,email,'.$id,
                'password' => 'string|min:8|confirmed',
            ],[
                'name.required'                  => 'El nombre es requerido',
                'email.unique'                   => 'Este email ya se encuentra en uso',
                'email.email'                    => 'El email debe de tener un formato ejemplo@ejemplo.com',
                'email.required'                 => 'El email es requerido',
                'password.min'                   => 'La contraseña debe de tener minimo 8 caracteres',
                'password.confirmed'             => 'Las contraseña no coinciden vuelva a intentar',            
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }

            $element= User::find($id);
            $rol=$request->get('rol') && isset($request->get('rol')["id"]) && !is_null($request->get('rol')["id"])? Rol::find($request->get('rol')["id"]) : null;
            if(is_null($element) || is_null($rol)){
                $messages=[];
                if(is_null($element)){
                    array_push($messages,'Usuario no existente');
                }
                if(is_null($rol)){
                    array_push($messages,'Rol no existente');
                }
                return response()->json(["message"=>$messages],404);
            }
            $element->fill($request->all());
            $element->id_rol = $rol->id;
            $element->update();

            $response = [
                'message'=> 'Usuario actualizado satisfactoriamente',
                'data' => User::find($element->id),
            ];
            return response()->json($response, 200);          
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ], 500);
        }
    }
    public function delete($id){
        try {
            $element = User::find($id);
            if(is_null($element)){
                return response()->json(['message'=>'Usuario no existente'],404);
            }
            $response = [
                'message'=> 'Usuario eliminado satisfactoriamente',
                'data' => $element,
            ];
            $element->delete();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de eliminar los datos.',
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ], 500);
        }
    }
}
