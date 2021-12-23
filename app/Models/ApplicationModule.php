<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationModule extends Model
{
    use HasFactory;
    
    protected $connection = 'sqlsrv';
    protected $table = 'front_integracion.dbo.application_modules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'full_path',
        'key'
    ];
}
