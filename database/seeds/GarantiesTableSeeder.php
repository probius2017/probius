<?php

use Illuminate\Database\Seeder;

class GarantiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('garanties')->insert([
        	'reference' => 'A'
        ]);

        DB::table('garanties')->insert([
        	'reference' => 'AK'
        ]);

        DB::table('garanties')->insert([
        	'reference' => 'ADEK'
        ]);

        DB::table('garanties')->insert([
        	'reference' => 'ADEK+MP'
        ]);
    }
}
