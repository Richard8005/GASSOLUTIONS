<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
        "direccion"=>"Cra 32 # 45-88 Muevo Sotomayor",
        "telefono"=>3002563057,
        "user_id"=>1]);

        Cliente::create([
        "direccion"=>"Cra 27 # 37-45 Sotomayor",
        "telefono"=>3012585014,
        "user_id"=>2]);

    }
}
