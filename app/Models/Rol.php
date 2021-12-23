<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RolApplicationModule;
class Rol extends Model
{
    use HasFactory;
    protected $table = 'front_integracion.dbo.rols';
    protected $fillable = [
        'name',
        'description',
    ];
    
    protected $with = ['modules'];
    public function modules()
    {
        return $this->hasMany(RolApplicationModule::class,'id_rol');
    }
}
