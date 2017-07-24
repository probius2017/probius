<?php

use App\Models\Contrat;
use Illuminate\Database\Seeder;

class LocauxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
            
        factory(App\Models\Local::class, 20)->create()->each(function ($local){ 

        	$structures = [1,2,3,4,5,6,7,8,9,10];
            $rand = array_rand($structures, 1);
        	$local->structures()->attach([$structures[$rand]]);

            //$local->structures()->attach([$structures[$rand[0]], $structures[$rand[1]]]);

            foreach ($local->structures as $struc) {

                if ($struc->type_structure == 'ACI (>=50)' || $struc->type_structure == 'ACI (jardin - >=50)') {

                    $contratACI = \App\Models\Contrat::create(
                    [
                        'num_contrat'        => '9322933',
                        'name_contrat'       => 'Dommages mobilier sup à 50RI',
                        'intercalaire'       => 'S00'.rand(1,100),
                        'local_id'           =>  $local->id,
                        'algeco_id'          =>  null
                    ]);

                    $contratRCPRO = \App\Models\Contrat::create(
                    [
                        'num_contrat'        => '971 0000 94067 F 50',
                        'name_contrat'       => 'RC PRO (ACI)',
                        'intercalaire'       => 'S00'.rand(1,100),
                        'local_id'           =>  $local->id,
                        'algeco_id'          =>  null
                    ]);

                }

                elseif ($struc->type_structure == 'ACI (jardin - <=25)' || $struc->type_structure == 'ACI (<=25)') {
                    
                    $contratRCPRO = \App\Models\Contrat::create(
                    [
                        'num_contrat'        => '971 0000 94067 F 50',
                        'name_contrat'       => 'RC PRO (ACI)',
                        'intercalaire'       => 'S00'.rand(1,100),
                        'local_id'           =>  $local->id,
                        'algeco_id'          =>  null
                    ]);

                }

                elseif ($struc->type_structure == 'Entrepot (>25)') {

                    $contratEntrepot = \App\Models\Contrat::create(
                    [
                        'num_contrat'        => '9453148',
                        'name_contrat'       => 'Entrepot >25RI',
                        'intercalaire'       => 'S00'.rand(1,100),
                        'local_id'           => $local->id,
                        'algeco_id'          =>  null
                    ]);

                }

                elseif ($struc->type_structure == 'Bien AN' && $struc->RI == '<=25') {
                    //$contratBienAN->local()->associate($local->id);

                    $contratBienAN = \App\Models\Contrat::create(
                    [
                        'num_contrat'        => '6665737',
                        'name_contrat'       => 'Bien AN legs',
                        'intercalaire'       => 'S00'.rand(1,100),
                        'local_id'           => $local->id,
                        'algeco_id'          =>  null
                    ]);
                }
            }

        });



        /*$struc->type_structure == 'ACI' && $struc->RI == '>=50' ? $contratACI->local()->associate($local->id) : null;

        /*$struc->type_structure == 'ACI (jardin)' && $struc->RI == '>=50' ? $contratACI->local()->associate($local->id) : null;

        $struc->type_structure == 'ACI' ? $contratRCPRO->local()->associate($local->id) : null;

        $struc->type_structure == 'ACI (jardin)' ? $contratRCPRO->local()->associate($local->id) : null;

        /*$struc->type_structure == 'Entrepot' && $struc->RI == '>=25' ? $contratEntrepot->local()->associate($local->id) : null;

        /*$struc->type_structure == 'Chambre froide' ? $contratCF->local()->associate($local->id) : null;

        $/*struc->type_structure == 'Bien AN' && $struc->RI == '<=25' ? $contratBienAN->local()->associate($local->id) : null;*/
            
            
        /*$contratRCPRO->save();
        $contratACI->save();
        $contratEntrepot->save();
        $contratCF->save();
        $contratBienAN->save();*/

    }
}
