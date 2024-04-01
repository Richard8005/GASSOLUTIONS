<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cotizacionmaterial;

class CotizacionmaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cotizacionmaterial::create(["cotizacions_id"=>5,
        "materials_id"=>3]);

        Cotizacionmaterial::create(["cotizacions_id"=>1,
        "materials_id"=>4]);

        Cotizacionmaterial::create(["cotizacions_id"=>2,
        "materials_id"=>5]);

    }
}
