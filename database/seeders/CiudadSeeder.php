<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ciudad;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ciudad::create(['nombre'=>"Bucaramanga"]);
        Ciudad::create(['nombre'=>"Floridablanca"]);
        Ciudad::create(['nombre'=>"Girón"]);
        Ciudad::create(['nombre'=>"Piedecuesta"]);
    }
}
