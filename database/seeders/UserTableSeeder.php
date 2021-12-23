<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rol;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol=Rol::where('name','administrador')->first();
        if(!is_null($rol)){
            $user=new User();
            $user->name="admin";
            $user->email="admin@front.com";
            $user->password=Hash::make("12345678");
            $user->id_rol=$rol->id;
            $user->save();
        }

    }
}
