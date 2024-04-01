<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use\App\Models\Tecnico;
use\App\Models\User;

class TecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => "Fernando Mosquera",
            'email' => "fernando@gmail.com",
            "password"=>bcrypt("TecF01")
        ]); 
        Tecnico::create([
            //"nombre"=>"Fernando Mosquera",
            "direccion"=>"Cll 19 # 12 - 125 Ciudad Valencia",
            "telefono"=>"3165172345",
            'user_id'=>$user1->id
            //"usuario"=>"femos01",
            //"contrasena"=>bcrypt("TecF01")
        ]);

        $user2 = User::create([
            'name' => "Alexander Contreras",
            'email' => "alex@gmail.com",
            "password"=>bcrypt("TecA02")
        ]); 
        Tecnico::create([
        "direccion"=>"Cll 14 # 24 - 85 San Francisco",
        "telefono"=>"3135134378",
        "user_id" => $user2->id
        ]);
/*

        Tecnico::create(["nombre"=>"Jhon Jairo Landinez",
        "direccion"=>"Cll 105 # 27 - 94 Provenza",
        "telefono"=>"3144784567",
        "usuario"=>"jlan03",
        "contrasena"=>bcrypt("TecA03")]);

        Tecnico::create(["nombre"=>"Marco Russi",
        "direccion"=>"Transv 145 # 54 - 68 El Carmen",
        "telefono"=>"3174784784",
        "usuario"=>"maru04",
        "contrasena"=>bcrypt("TecM04")]);
*/
    }
}
