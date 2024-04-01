<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tipo;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo::create(["descripcion"=>"Revision Periodica"]);
        Tipo::create(["descripcion"=>"Mantenimiento Estufa"]);
        Tipo::create(["descripcion"=>"Certificacion instalacion"]);
        Tipo::create(["descripcion"=>"Instalacion interna 5-10 mt"]);
        Tipo::create(["descripcion"=>"Instalacion interna 11-15 mt"]);
        Tipo::create(["descripcion"=>"Instalacion interna 16-20 mt"]);
        Tipo::create(["descripcion"=>"Instalacion interna 21-25 mt"]);
        Tipo::create(["descripcion"=>"Visita de inspeccion"]);
    }
}
