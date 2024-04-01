<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        

        User::create([
            'name' =>"Freddy Mendez",
            'email' => "fmendezo@sena.edu.co",
            'password' => bcrypt("Clfm2034")
        ]);

        User::create([
            'name' => "James Cameron",
            'email' => "jcameron@sena.edu.co",
            'password' => bcrypt("Jc2045"),
        ]);

        User::create([
            'name' =>"Ricardo Caicedo",
            'email' => "rcaicedo8005@gmail.com",
            'password' => bcrypt("13745579")
        ]);

        
    }
}
