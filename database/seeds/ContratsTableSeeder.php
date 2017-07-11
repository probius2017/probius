<?php

use Illuminate\Database\Seeder;

class ContratsTableSeeder extends Seeder
{	
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $contratSocle = \App\Models\Contrat::create(
            [
                'num_contrat'        => '3411862',
                'name_contrat'       => 'Contrat socle',
                'intercalaire'       => null,
                'local_id_FK'        => null,
                'algeco_id'          =>  null
            ]
        );

        $contratCulture = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9454153',
                'name_contrat'       => 'Culture loisirs',
                'intercalaire'       =>  null,
                'local_id_FK'        =>  null,
                'algeco_id'          =>  null
            ]
        );

        $contratVac = \App\Models\Contrat::create(
            [
                'num_contrat'        => '9454143',
                'name_contrat'       => 'rapatriement RC vacances manif',
                'intercalaire'       => null,
                'local_id_FK'        => null,
                'algeco_id'          => null
            ]
        );
    }
}
