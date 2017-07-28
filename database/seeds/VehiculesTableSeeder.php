<?php

use App\Models\Vehicule;
use App\Models\Modele;
use Illuminate\Database\Seeder;

class VehiculesTableSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //5 véhicules crées
        $veh1 = Vehicule::create(
        	[
        		'immat'                => 'CC 986 EJ',
		        'old_immat'            => null,
		        'pmc'                  => '2015-03-04',
                'atp'                  => '2026-07-17',
		        'marque_id'			   => 2,
		        'contrat_v_id'		   => 9,
		        'ad_id'				   => rand(1, 119),
                'modele_id'            => 1
        	]);

        Vehicule::create(
        	[
        		'immat'                => 'CC 986 HY',
		        'old_immat'            => 'EF-086-ZE',
		        'pmc'                  => '2001-02-14',
		        'atp'          		   => '2020-05-01',
		        'marque_id'			   => 2,
		        'contrat_v_id'		   => 2,
		        'ad_id'				   => rand(1, 119),
                'modele_id'            => 4
        	]);
       	
       	Vehicule::create(
        	[
        		'immat'                => 'UY 936 HY',
		        'old_immat'            => null,
		        'pmc'                  => '2003-03-04',
                'atp'                  => '2022-08-17',
		        'marque_id'			   => 1,
		        'contrat_v_id'		   => 3,
		        'ad_id'				   => rand(1, 119),
                'modele_id'            => 2
        	]);

       	Vehicule::create(
        	[
        		'immat'                => 'UA 346 ZE',
		        'old_immat'            => 'XC-129-JK',
		        'pmc'                  => '1999-01-01',
                'atp'                  => '2019-06-15',
		        'marque_id'			   => 5,
		        'contrat_v_id'		   => 4,
		        'ad_id'				   => rand(1, 119),
                'modele_id'            => 3
        	]);

       	Vehicule::create(
        	[
        		'immat'                => 'TR 435 ER',
		        'old_immat'            => null,
		        'pmc'                  => '2008-12-12',
                'atp'                  => '2025-09-03',
		        'marque_id'			   => 5,
		        'contrat_v_id'		   => 5,
		        'ad_id'				   => rand(1, 119),
                'modele_id'            => 3
        	]);
    }
}
