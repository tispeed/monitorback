<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationModule;

class ApplicationModuleController extends Controller
{
    public function all(){
        try {
            $response = [
                'message'=> 'Lista de módulos',
                'data' => ApplicationModule::all(),
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
}
