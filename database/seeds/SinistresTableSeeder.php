<?php

use Illuminate\Database\Seeder;

class SinistresTableSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker\Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nbContrats = \App\Models\Contrat::count();
        $nbContratsV = \App\Models\ContratV::count();
        $resp = array('0%', '50%', '100%');

        DB::table('sinistres')->insert([

            [
                'ref_rdc'           => $this->faker->creditCardNumber,
                'ref_macif'         => $this->faker->creditCardNumber,
                'date_reception'    => $this->faker->date,
                'date_ouverture'    => $this->faker->date,
                'date_sinistre'     => $this->faker->date,
                'ville_sinistre'    => $this->faker->state, 
                'cp_sinistre'       => $this->faker->randomNumber(5, false),
                'responsabilite'    => $resp[array_rand($resp)],
                'observation'       => $this->faker->realText(150, 1),
                'reglement_macif'   => $this->faker->randomFloat(NULL, 10, 1000), 
                'franchise'         => $this->faker->randomFloat(NULL, 10, 1000),
                'solde_ad'          => $this->faker->randomFloat(NULL, 10, 1000),
                'date_cloture'      => null,
                'contrat_id'        => null,
                'type_sinistre_id'  => 2,
                'contrat_v_id'      => 9
            ],

            [
                'ref_rdc'           => $this->faker->creditCardNumber,
                'ref_macif'         => $this->faker->creditCardNumber,
                'date_reception'    => $this->faker->date,
                'date_ouverture'    => $this->faker->date,
                'date_sinistre'     => $this->faker->date,
                'ville_sinistre'    => $this->faker->state, 
                'cp_sinistre'       => $this->faker->randomNumber(5, false),
                'responsabilite'    => $resp[array_rand($resp)],
                'observation'       => $this->faker->realText(150, 1),
                'reglement_macif'   => $this->faker->randomFloat(NULL, 10, 1000), 
                'franchise'         => $this->faker->randomFloat(NULL, 10, 1000),
                'solde_ad'          => $this->faker->randomFloat(NULL, 10, 1000),
                'date_cloture'      => $this->faker->date,
                'contrat_id'        => 1,
                'type_sinistre_id'  => rand(1, 10),
                'contrat_v_id'      => null
            ],

            [
                'ref_rdc'           => $this->faker->creditCardNumber,
                'ref_macif'         => $this->faker->creditCardNumber,
                'date_reception'    => $this->faker->date,
                'date_ouverture'    => $this->faker->date,
                'date_sinistre'     => $this->faker->date,
                'ville_sinistre'    => $this->faker->state, 
                'cp_sinistre'       => $this->faker->randomNumber(5, false),
                'responsabilite'    => $resp[array_rand($resp)],
                'observation'       => $this->faker->realText(150, 1),
                'reglement_macif'   => $this->faker->randomFloat(NULL, 10, 1000), 
                'franchise'         => $this->faker->randomFloat(NULL, 10, 1000),
                'solde_ad'          => $this->faker->randomFloat(NULL, 10, 1000),
                'date_cloture'      => null,
                'contrat_id'        => null,
                'type_sinistre_id'  => rand(1, 10),
                'contrat_v_id'      => 9
            ],

            [
                'ref_rdc'           => $this->faker->creditCardNumber,
                'ref_macif'         => $this->faker->creditCardNumber,
                'date_reception'    => $this->faker->date,
                'date_ouverture'    => $this->faker->date,
                'date_sinistre'     => $this->faker->date,
                'ville_sinistre'    => $this->faker->state, 
                'cp_sinistre'       => $this->faker->randomNumber(5, false),
                'responsabilite'    => $resp[array_rand($resp)],
                'observation'       => $this->faker->realText(150, 1),
                'reglement_macif'   => $this->faker->randomFloat(NULL, 10, 1000), 
                'franchise'         => $this->faker->randomFloat(NULL, 10, 1000),
                'solde_ad'          => $this->faker->randomFloat(NULL, 10, 1000),
                'date_cloture'      => null,
                'contrat_id'        => 12,
                'type_sinistre_id'  => rand(1, 10),
                'contrat_v_id'      => null
            ]
        ]);

    }
}
