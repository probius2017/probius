<?php

use Illuminate\Database\Seeder;

class MarquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marques')->insert([
        	'name_marque' => 'Peugeot'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'Renault'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'Citroën'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'Mercedes-Benz'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'BMW'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'FIAT'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'SEAT'
        ]);

        DB::table('marques')->insert([
        	'name_marque' => 'Volkswagen'
        ]);

        $marque = DB::table('marques')->insert([
        	'name_marque' => 'Honda'
        ]);
    }
}
