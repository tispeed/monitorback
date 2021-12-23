<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\ApplicationModule;
use App\Models\RolApplicationModule;
class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $rol=new Rol();
        $rol->name="administrador";
        $rol->description="administrador";
        $rol->save();

        $modules=ApplicationModule::all();
        foreach ($modules as $key => $value) {
            RolApplicationModule::create([
                'id_rol'=>$rol->id,
                'id_application_module'=>$value->id,
            ]);
        }
    }
}
