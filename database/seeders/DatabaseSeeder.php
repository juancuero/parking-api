<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'juan.cuero',
            'name' => 'Juan Cuero',
            'email' => 'juan.cuero@unillanos.edu.co',
            'password' => bcrypt('juancuero123'),
        ]);

        DB::table('users')->insert([
            'username' => 'juan.camacho',
            'name' => 'Juan Camacho',
            'email' => 'juan.camacho@unillanos.edu.co',
            'password' => bcrypt('juancamacho123'),
        ]);

        DB::table('type_vehicles')->insert([
            'name' => 'Auto',
            'acronym' => 'A',
            'price' => 7000
        ]);

        DB::table('type_vehicles')->insert([
            'name' => 'Moto',
            'acronym' => 'M',
            'price' => 5000
        ]);

        DB::table('places')->insert(
            [
                ['lot' => 1,'type_vehicle_id' => 1],
                ['lot' => 2,'type_vehicle_id' => 1],
                ['lot' => 3,'type_vehicle_id' => 1],
                ['lot' => 1,'type_vehicle_id' => 2],
                ['lot' => 2,'type_vehicle_id' => 2]
            ]
        );


    }
}
