<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agendamiento;

class AgendamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agendamiento::create(["hora"=>"10:30:00",
        "estado"=>"Pendiente",
        "fecha"=>"2023-06-15",
        "servicios_id"=>2,
        "tecnicos_id"=>1,
        ]);

        Agendamiento::create(["hora"=>"14:30:00",
        "estado"=>"Ejecutado",
        "fecha"=>"2023-06-13",
        "servicios_id"=>1,
        "tecnicos_id"=>1,
        ]);

        Agendamiento::create(["hora"=>"16:30:00",
        "estado"=>"Pendiente",
        "fecha"=>"2023-06-15",
        "servicios_id"=>2,
        "tecnicos_id"=>1,
        ]);


    }
}
