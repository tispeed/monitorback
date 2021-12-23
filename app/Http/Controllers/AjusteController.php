<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajuste;

class AjusteController extends Controller
{
    public function all(){
        try {
            $response = [
                'message'=> 'Lista de ajuste join',
                //'data' => Ajuste::all(),
                'data'=> Ajuste::select('COMUNICACIONES.dbo.TBL_AJUSTES.*', 'Integracion.dbo.LOG_INTEGRACION_SAP.Folio_num as DOCNUM')
                ->leftJoin('Integracion.dbo.LOG_INTEGRACION_SAP', 'COMUNICACIONES.dbo.TBL_AJUSTES.ID', '=', 'Integracion.dbo.LOG_INTEGRACION_SAP.ID')
                //->leftJoin('Integracion.dbo.LOG_INTEGRACION_SAP', 'COMUNICACIONES.dbo.TBL_AJUSTES.ID', '=', 'Integracion.dbo.LOG_INTEGRACION_SAP.correlativo_sap')
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
    public function getByRangeDate(Request $request){
        try {
            $response = [
                'message'=> 'Lista de transferencia por rango de fechas',
                'data'=> Ajuste::select('COMUNICACIONES.dbo.TBL_AJUSTES.*', 'Integracion.dbo.LOG_INTEGRACION_SAP.Folio_num as DOCNUM')
                    ->leftJoin('Integracion.dbo.LOG_INTEGRACION_SAP', 'COMUNICACIONES.dbo.TBL_AJUSTES.ID', '=', 'Integracion.dbo.LOG_INTEGRACION_SAP.ID')
                    //->leftJoin('Integracion.dbo.LOG_INTEGRACION_SAP', 'COMUNICACIONES.dbo.TBL_AJUSTES.ID', '=', 'Integracion.dbo.LOG_INTEGRACION_SAP.correlativo_sap')
                    ->whereBetween('FECHA_TRANSACCION',[$request->get('from'),$request->get('to')])->get()
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
    public function changeStatus(Request $request){
        try {
            $element= Ajuste::where('ID',$request->get('ID'))->first();
            if(is_null($element)){
                return response()->json(['message'=>'Ajuste no existente'],404);
            }
            $query_result=Ajuste::where('ID',$element->ID)->update([
                'OBS_ADMINISTRADOR' => $request->get('OBS_ADMINISTRADOR'),
                'ESTADO_INTEGRACION' => $request->get('STATUS')
            ], ['timestamps' => false]);
            $response = [
                'message'=> 'Cambio de status satisfactorio',
                '$query_result'=>$query_result,
                'data'=>  Ajuste::where('ID',$element->ID)->first()
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
    public function changeAccountingAccount(Request $request){
        try {
            $element= Ajuste::where('ID',$request->get('ID'))->first();
            if(is_null($element)){
                return response()->json(['message'=>'Ajuste no existente'],404);
            }
            $query_result=Ajuste::where('ID',$element->ID)->update([
                'CUENTA_CONTABLE' => $request->get('CUENTA_CONTABLE'),
            ], ['timestamps' => false]);
            $response = [
                'message'=> 'Cambio de status satisfactorio',
                '$query_result'=>$query_result,
                'data'=>  Ajuste::where('ID',$element->ID)->first()
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
