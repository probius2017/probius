<?php

use Illuminate\Database\Seeder;

class StructuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('structures')->insert([

        	['type_structure' => 'Centre activité',
             'RI' => '<=25'
            ],

        	['type_structure' => 'Stockage',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Entrepot (<=25)',
            'RI' => '<=25'
            ],

            ['type_structure' => 'Entrepot (>25)',
             'RI' => '>=25'
            ],

        	['type_structure' => 'ACI (<=25)',
            'RI' => '<=25'
            ],

            ['type_structure' => 'ACI (>=50)',
             'RI' => '>=50'
            ],

        	['type_structure' => 'ACI (jardin - <=25)',
            'RI' => '<=25'
            ],

        	['type_structure' => 'ACI (jardin - >=50)',
            'RI' => '>=50'
            ],

            ['type_structure' => 'Bien AN',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Siège AD',
            'RI' => '<=25'
            ]

            /*['type_structure' => 'Chambre froide',
            'RI' => null
            ]*/

        	/*['type_structure' => 'Petite ruche DREUX',
            'RI' => null
            ],

        	['type_structure' => 'Petite ruche BLOIS',
            'RI' => null
            ],

        	['type_structure' => 'Petite ruche AGENT AIRCA',
            'RI' => null
            ],

        	['type_structure' => 'Péniche',
             'RI' => null
            ]*/

        ]);
    }
}
