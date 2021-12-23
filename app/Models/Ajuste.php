<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    use HasFactory;
    //protected $connection = 'sqlsrv1';
    protected $table = 'COMUNICACIONES.dbo.TBL_AJUSTES';
    protected $fillable = [
        'ESTADO_INTEGRACION',
        'FECHA_TRANSACCION',
        'CODIGO_CLIENTE', 
        'CANTIDAD',
        'LOTE',
        'CONTRATO_ACTUAL',
        'ESTADO',
        'ALMACEN_ACTUAL', 
        'TIPO_MOVIMIENTO',
        'CODIGO_MOTIVO',
        'MOTIVO',
        'SKU_GF',
        'EXPIRACION_LOTE',
        'FOLIO_GOLDEN_FROST',
        'DOCNUM',
        'OBS_REGLA',
        'OBS_ADMINISTRADOR',
        'CUENTA_CONTABLE',
        'RETENER_AJUSTE',
        'COSTO_PROMEDIO'
    ];
    public $timestamps = false;
}
