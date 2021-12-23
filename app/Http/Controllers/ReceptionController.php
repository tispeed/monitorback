<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceptionController extends Controller
{
    public function getDIRecepcionesGFAUTbyRangeDate(Request $request){
        try {
            $response = [
                'message'=> 'Lista de DI recepciones GF AUTH',
                'data'=> DB::table('COMUNICACIONES.dbo.DI_RECEPCIONES_GF_AUT')
                    ->select('*')
                    ->whereBetween('FECHA_RECEPCION', [$request->get("from"), $request->get("to")])
                    ->get()
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
    public function getDIRecepcionesDFbyRangeDateAndReserva($reserva,Request $request){
        try {
            $response = [
                'message'=> 'Lista de DI recepciones DF por reserva: '.$reserva,
                'data'=> DB::table('COMUNICACIONES.dbo.DI_RECEPCIONES_GF_AUT')
                    ->select('*')
                    ->where('OC/FACT RESERVA', $reserva)
                    ->whereBetween('FECHA_RECEPCION', [$request->get("from"), $request->get("to")])
                    ->get()
                // 'data'=> DB::select("SELECT COMUNICACIONES.dbo.DI_RECEPCIONES_GF.* FROM COMUNICACIONES.dbo.DI_RECEPCIONES_GF WHERE FECHA_HORA BETWEEN '" . $request->get("from") . "' AND '" . $request->get("to") . "'", [1])
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
    
    public function getDIRecepcionesDFbyRangeDate(Request $request){
        try {
            $response = [
                'message'=> 'Lista de DI recepciones DF',
                'data'=> DB::table('COMUNICACIONES.dbo.DI_RECEPCIONES_GF')
                    ->select('*')
                    ->whereBetween('FECHA_HORA', [$request->get("from"), $request->get("to")])
                    ->get()
                // 'data'=> DB::select("SELECT COMUNICACIONES.dbo.DI_RECEPCIONES_GF.* FROM COMUNICACIONES.dbo.DI_RECEPCIONES_GF WHERE FECHA_HORA BETWEEN '" . $request->get("from") . "' AND '" . $request->get("to") . "'", [1])
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
    public function getDIRecepcionesDFbyRangeDateAndFolio($folio,Request $request){
        try {
            $response = [
                'message'=> 'Lista de DI recepciones DF por folio: '.$folio,
                'data'=> DB::table('COMUNICACIONES.dbo.DI_RECEPCIONES_GF')
                    ->select('*')
                    ->where('FOLIO', $folio)
                    ->whereBetween('FECHA_HORA', [$request->get("from"), $request->get("to")])
                    ->get()
                // 'data'=> DB::select("SELECT COMUNICACIONES.dbo.DI_RECEPCIONES_GF.* FROM COMUNICACIONES.dbo.DI_RECEPCIONES_GF WHERE FECHA_HORA BETWEEN '" . $request->get("from") . "' AND '" . $request->get("to") . "'", [1])
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
