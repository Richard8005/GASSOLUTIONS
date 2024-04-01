<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cotizacion;

class CotizacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cotizacion::create(["costo"=>55000, "agendamientos_id"=>1]);
        Cotizacion::create(["costo"=>120000,"agendamientos_id"=>3]);
        Cotizacion::create(["costo"=>150000,"agendamientos_id"=>2]);
        Cotizacion::create(["costo"=>350000,"agendamientos_id"=>3]);
        Cotizacion::create(["costo"=>500000,"agendamientos_id"=>1]);
        Cotizacion::create(["costo"=>600000,"agendamientos_id"=>2]);
        Cotizacion::create(["costo"=>700000,"agendamientos_id"=>2]);
        Cotizacion::create(["costo"=>30000,"agendamientos_id"=>3]);

    }
}
