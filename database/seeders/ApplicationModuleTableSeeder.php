<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationModule;
class ApplicationModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules=[[
            'name'=>'Traspasos',
            'full_path'=>'/admin/monitors/transfers',
            'key'=>'transfers'
        ],[
            'name'=>'Ajustes',
            'full_path'=>'/admin/monitors/settings',
            'key'=>'settings'
        ],[
            'name'=>'Ver Recepcion',
            'full_path'=>'/admin/monitors/see-reception',
            'key'=>'see-reception'
        ],[
            'name'=>'Administración Usuarios',
            'full_path'=>'/admin/safety/users',
            'key'=>'users'
        ],[
            'name'=>'Recepción por Integración',
            'full_path'=>'/admin/reception/reception-integration',
            'key'=>'reception-integration'
            
        ],[
            'name'=>'Recepción y Devoluciones Manuales',
            'full_path'=>'/admin/safety/reception-manual-returns',
            'key'=>'reception-manual-returns'
        ]];
        foreach ($modules as $key => $value) {
            ApplicationModule::create($value);
        }
    }
}
