<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TipoSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(TecnicoSeeder::class);
        $this->call(ServicioSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(AgendamientoSeeder::class);
        $this->call(CotizacionSeeder::class);
        $this->call(EvaluacionSeeder::class);
        $this->call(EvidenciaSeeder::class);
        $this->call(CotizacionmaterialSeeder::class);

    }
}
