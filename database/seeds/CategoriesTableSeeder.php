<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
        	'type' => '2 ROUES'
        ]);

        DB::table('categories')->insert([
        	'type' => 'VP'
        ]);

        DB::table('categories')->insert([
        	'type' => 'UL'
        ]);

        DB::table('categories')->insert([
        	'type' => 'UL FRIGO'
        ]);

        DB::table('categories')->insert([
        	'type' => 'PL'
        ]);

        DB::table('categories')->insert([
        	'type' => 'PL FRIGO'
        ]);

        DB::table('categories')->insert([
        	'type' => 'ENGIN'
        ]);

        DB::table('categories')->insert([
        	'type' => 'Bus'
        ]);

        DB::table('categories')->insert([
        	'type' => 'Tracteur'
        ]);

        DB::table('categories')->insert([
        	'type' => 'Remorques'
        ]);
    }
}
