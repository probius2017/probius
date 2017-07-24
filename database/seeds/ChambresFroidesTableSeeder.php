<?php

use Illuminate\Database\Seeder;
use App\Models\Contrat;

class ChambresFroidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chambresFroides')->insert(
      	[
	       	[
	       		'volume' 	=> '32',
	       		'local_id' 	=> 2
	       	],

	       	[
	       		'volume' 	=> '58',
	       		'local_id' 	=> 2
	       	],

	       	[
	       		'volume' 	=> '42,3',
	       		'local_id' 	=> 6
	       	],

	       	[
	       		'volume' 	=> '9',
	       		'local_id' 	=> 8
	       	],

	       	[
	       		'volume' 	=> '11',
	       		'local_id' 	=> 19
	       	],

      	]);

      	$contratCF1 = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9453062',
                'name_contrat'       => 'Contrat flotte Chambre froide',
                'local_id'           =>  2,
                'algeco_id'          =>  null
            ]);

      	$contratCF2 = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9453062',
                'name_contrat'       => 'Contrat flotte Chambre froide',
                'local_id'           =>  6,
                'algeco_id'          =>  null
            ]);
      	$contratCF3 = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9453062',
                'name_contrat'       => 'Contrat flotte Chambre froide',
                'local_id'           =>  8,
                'algeco_id'          =>  null
            ]);
      	$contratCF4 = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9453062',
                'name_contrat'       => 'Contrat flotte Chambre froide',
                'local_id'           =>  19,
                'algeco_id'          =>  null
            ]);

    }
}
