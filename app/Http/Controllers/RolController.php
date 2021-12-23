<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Rol;
use App\Models\RolApplicationModule;

use Illuminate\Http\Request;

class RolController extends Controller
{
    public function all(){
        try {
            $response = [
                'message'=> 'Lista de roles',
                'data' => Rol::all(),
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
                'description'                    => 'required|string',
            ],[
                'name.required'                  => 'El nombre es requerido',
                'name.string'                    => 'El nombre debe ser cadena de texto',
                'description.required'           => 'La descripción es requerido',
                'description.string'             => 'La descripción debe ser cadena de texto',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $element = Rol::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),    
            ]);

            //registro de modulos del rol
            $modules=json_decode($request->get('modules'));
            foreach ($modules as $key => $value) {
                RolApplicationModule::create([
                    'id_rol'=>$element->id,
                    'id_application_module'=>$value->id,
                ]);
            }

            return response()->json([
                'message'=> 'Rol registrado satisfactoriamente',
                'data' => $element
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
                'error' => $e->getMessage(),
                'linea' => $e->getLine()
            ], 500);
        }
    }
    /*actualizacion de elemento (roles)*/
    public function update(Request $request,$id){        
        try {
            $validator = Validator::make($request->all(), [
                'name'                           => 'required|string',
                'description'                    => 'required|string',
            ],[
                'name.required'                  => 'El nombre es requerido',
                'name.string'                    => 'El nombre debe ser cadena de texto',
                'description.required'           => 'La descripción es requerido',
                'description.string'             => 'La descripción debe ser cadena de texto',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $element= Rol::find($id);
            if(is_null($element)){
                return response()->json(['message'=>'Rol no existente'],404);
            }
            $element->fill($request->all());
            
            //actualiza modulos del rol
            //elimina los existentes
            RolApplicationModule::where(['id_rol'=>$element->id])->delete();
            //registro de modulos del rol
            $modules=json_decode($request->get('modules'));
            foreach ($modules as $key => $value) {
                RolApplicationModule::create([
                    'id_rol'=>$element->id,
                    'id_application_module'=>$value->id,
                ]);
            }

            $response = [
                'message'=> 'Rol actualizado satisfactoriamente',
                'data' => Rol::find($element->id),
            ];
            $element->update();
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
            $element = Rol::find($id);
            if(is_null($element)){
                return response()->json(['message'=>'Rol no existente'],404);
            }
            $response = [
                'message'=> 'Rol eliminado satisfactoriamente',
                'data' => $element,
            ];

            //elimina modulos del rol
            RolApplicationModule::where(['id_rol'=>$element->id])->delete();

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
