<?php

use Illuminate\Database\Seeder;

class AntennesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('antennes')->insert([
            'antenne_name' => 'Nord - Pas de Calais - Picardie',
            'numero_antenne' => '01',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Paris - Ile de France',
            'numero_antenne' => '02',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Bretagne - Pays de Loire',
            'numero_antenne' => '03',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Centre - Limousin',
            'numero_antenne' => '04',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Aquitaine - Poitou-Charentes',
            'numero_antenne' => '05',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Midi-Pyrénnées',
            'numero_antenne' => '06',
       	 	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'PACA - Corse - Languedoc-Roussillon',
            'numero_antenne' => '07',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Rhône-Alpes - Auvergne',
            'numero_antenne' => '08',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Bourgogne - Franche-Comté',
            'numero_antenne' => '09',
       	]);
       	 	
        DB::table('antennes')->insert([
            'antenne_name' => 'Champagne-Ardenne - Alsace - Lorraine',
            'numero_antenne' => '10',
       	]);

       	DB::table('antennes')->insert([
            'antenne_name' => 'Normandie',
            'numero_antenne' => '11',
       	]);
    }
}
