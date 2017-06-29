<?php

use Illuminate\Database\Seeder;

class ModelesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modeles')->insert([
        	'name_modele' => 'BOXER',
        	'marque_id' => 2,
        	'category_id' => 3
        ]);

        DB::table('modeles')->insert([
        	'name_modele' => 'EXPRESS',
        	'marque_id' => 1,
            'category_id' => 3
        ]);

        DB::table('modeles')->insert([
        	'name_modele' => 'MONSTER',
        	'marque_id' => 5,
            'category_id' => 2
        ]);

        DB::table('modeles')->insert([
        	'name_modele' => 'MEGANE',
        	'marque_id' => 2,
            'category_id' => 3
        ]);

        DB::table('modeles')->insert([
            'name_modele' => 'MEGANE',
            'marque_id' => 2,
            'category_id' => 3
        ]);
    }
}
