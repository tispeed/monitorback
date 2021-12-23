<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;
    //protected $connection = 'sqlsrv1';
    protected $table = 'COMUNICACIONES.dbo.TBL_TRASPASO';
    protected $fillable = [
        'ESTADO_INTEGRACION',
        'FECHA_TRANSACCION',
        'SKU', 
        'SKU_NUEVO',
        'CANTIDAD',
        'CONTRATO_ACTUAL',
        'ESTADO',
        'CONTRATO_NUEVO', 
        'ESTADO_NUEVO',
        'LOTE',
        'LOTE_NUEVO',
        'ALMACEN_ACTUAL',
        'ALMACEN_NUEVO',
        'PALLET',
        'FOLIO_GOLDEN_FROST',
        'DOCNUM',
        'UxC',
        'UxC_nuevo',
        'OBS_REGLA',
        'OBS_ADMINISTRADOR'
    ];
    public $timestamps = false;
}
