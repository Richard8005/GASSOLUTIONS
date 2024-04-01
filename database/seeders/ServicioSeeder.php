<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::create(["direccion"=>"Cra 32 # 45-88 Muevo Sotomayor",
        "fecha"=>"2023-11-15",
        "hora"=>"15:00:00",
        "tipos_id"=>1,
        "ciudades_id"=>1,
        "cliente_id"=>1,
        "tecnicos_id"=>1,
    ]);
    
        Servicio::create(["direccion"=>"Cra 24 # 14-45 San Francisco",
        "fecha"=>"2023-08-20",
        "hora"=>"10:30:00",
        "tipos_id"=>8,
        "ciudades_id"=>1,
        "cliente_id"=>1,
        "tecnicos_id"=>1,
    ]);

    }

}
