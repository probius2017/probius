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

            /*['type_structure' => 'Centre activité'
            ],

            ['type_structure' => 'Stockage'
            ],

            ['type_structure' => 'Entrepot'
            ],

            ['type_structure' => 'Entrepot (>=25RI)'
            ],

            ['type_structure' => 'ACI'
            ],

            ['type_structure' => 'ACI (>=50RI)'
            ],

            ['type_structure' => 'ACI (jardin)'
            ],

            ['type_structure' => 'Chambre froide'
            ],

            ['type_structure' => 'Biens AN'
            ],

            ['type_structure' => 'Siège AD'
            ],

            ['type_structure' => 'Petite ruche DREUX'
            ],

            ['type_structure' => 'Petite ruche BLOIS'
            ],

            ['type_structure' => 'Petite ruche AGENT AIRCA'
            ],

            ['type_structure' => 'Péniche'
            ]*/

        	['type_structure' => 'Centre activité',
             'RI' => '<=25'
            ],

        	['type_structure' => 'Stockage',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Entrepot',
            'RI' => '<=25'
            ],

            ['type_structure' => 'Entrepot',
             'RI' => '>=25'
            ],

        	['type_structure' => 'ACI',
            'RI' => '<=25'
            ],

            ['type_structure' => 'ACI',
             'RI' => '>=50'
            ],

        	['type_structure' => 'ACI (jardin)',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Chambre froide',
            'RI' => null
            ],

            ['type_structure' => 'Bien AN',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Siège AD',
            'RI' => '<=25'
            ],

        	['type_structure' => 'Petite ruche DREUX',
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
            ]

        ]);
    }
}
