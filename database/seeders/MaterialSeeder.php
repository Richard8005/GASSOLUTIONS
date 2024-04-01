<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::create(["codigos"=>"P001",
        "descripcion"=>"Pealpe 1/2 pulg * mt"]); 
        Material::create(["codigos"=>"RM001",
        "descripcion"=>"Racor macho 1/2 Pulg"]); 
        Material::create(["codigos"=>"RH001",
        "descripcion"=> "Racor hembra 1/2 Pulg"]);
        Material::create(["codigos"=>"UP001",
        "descripcion"=> "Union Pealpe 1/2 Pulg"]);
        Material::create(["codigos"=>"G001",
        "descripcion"=> "Pegante Gastop Fuerza alta"]);
        Material::create(["codigos"=>"V001",
        "descripcion"=> "Valvula Gas Bola 1/2 Pulg"]);
        Material::create(["codigos"=>"UG001",
        "descripcion"=> "Union Galvanizada 1/2 Pulg"]);
    }
}
