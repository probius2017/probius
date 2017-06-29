<?php

use Illuminate\Database\Seeder;

class ContratVTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //10 contrats crées
        $contrat = '1000 16 919';

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);

        DB::table('contrat_v')->insert([
        	'numero_contratV' => $contrat,
        	'garantie_id' => rand(1, 4)
        ]);
    }
}
