<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolApplicationModule extends Model
{
    use HasFactory;
    
    protected $connection = 'sqlsrv';
    protected $table = 'front_integracion.dbo.rol_application_modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_rol',
        'id_application_module',
    ];
    protected $with = ['module'];
    public function module()
    {
        return $this->hasOne(ApplicationModule::class,'id','id_application_module');
    }
}
