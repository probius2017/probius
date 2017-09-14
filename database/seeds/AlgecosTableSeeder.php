<?php

use Illuminate\Database\Seeder;

class AlgecosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Algeco::class, 20)->create()->each(function ($algeco){ 

        	$contratALG = \App\Models\Contrat::create(
                [
                    'num_contrat'        => '9453755',
                    'name_contrat'       => 'Algeco',
                    'intercalaire'       => 'A00'.rand(1,100),
                    'type_contrat'       =>  6,
                    'local_id'           =>  null,
                    'algeco_id'          =>  null,
                    'logement_id'        =>  null
                ]);

        	$contratALG->algeco()->associate($algeco->id);
            $contratALG->save();
        });

        /*$contratALGTest = \App\Models\Contrat::create(
                [
                    'num_contrat'        => '9453755',
                    'name_contrat'       => 'Algeco',
                    'intercalaire'       => 'A0000',
                    'type_contrat'       =>  6,
                    'local_id'           =>  null,
                    'algeco_id'          =>  null,
                    'logement_id'        =>  null
                ]);
        $contratALGTest->algeco()->associate(1);
        $contratALGTest->save();*/
    }
}
