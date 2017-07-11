<?php

use Illuminate\Database\Seeder;

class ChampsUpdateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('champsUpdate')->insert([

        	[
        		'old_name' => 'numero_ad',
        		'new_name' => 'Ad',
        		'table_name' => 'locaux',
                'status' => 1
        	],
            [
                'old_name' => 'num_contrat',
                'new_name' => 'Numéro de contrat',
                'table_name' => 'contrats',
                'status' => 0
            ],
            
            [
                'old_name' => 'intercalaire',
                'new_name' => 'Intercalaire',
                'table_name' => 'contrats',
                'status' => 1
            ],
            /*[
                'old_name' => 'name_contrat',
                'new_name' => 'nom du contrat',
                'table_name' => 'contrats',
                'status' => 0
            ],*/
        	[
        		'old_name' => 'cp_local',
        		'new_name' => 'Code postal',
        		'table_name' => 'locaux',
                'status' => 1
        	],

        	[
        		'old_name' => 'ville_local',
        		'new_name' => 'Ville',
        		'table_name' => 'locaux',
                'status' => 1

        	],
            [
                'old_name' => 'adresse_local',
                'new_name' => 'Adresse',
                'table_name' => 'locaux',
                'status' => 1
            ],
            [
                'old_name' => 'complementGeographique',
                'new_name' => 'Complément adresse',
                'table_name' => 'locaux',
                'status' => 0
            ],
            [
                'old_name' => 'apptEscalier',
                'new_name' => 'Mentions complémentaires',
                'table_name' => 'locaux',
                'status' => 0
            ],
        	[
        		'old_name' => 'superficie',
        		'new_name' => 'Superficie',
        		'table_name' => 'locaux',
                'status' => 1

        	],
        	[
        		'old_name' => 'ERP',
        		'new_name' => 'ERP',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'precaire',
        		'new_name' => 'Précaire',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'etat_ini',
        		'new_name' => 'Etat initial',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'nom_bailleur',
        		'new_name' => 'Nom bailleur',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'info_bailleur',
        		'new_name' => 'Info bailleur',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'loyer',
        		'new_name' => 'Loyer',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'detail_loyer',
        		'new_name' => 'Détail loyer',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'prix_m2',
        		'new_name' => 'Prix m²',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'pret',
        		'new_name' => 'Pret',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'local_partage',
        		'new_name' => 'Local partage',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'precision_partage',
        		'new_name' => 'Précision partage',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'accessibilite',
        		'new_name' => 'Accessibilité',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'observation_generale',
        		'new_name' => 'Observation',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'charge_bailleur',
        		'new_name' => 'Charge bailleur',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'charge_rdc',
        		'new_name' => 'Charge RDC',
        		'table_name' => 'locaux',
                'status' => 0
        	],
        	[
        		'old_name' => 'contenu',
        		'new_name' => 'Contenu',
        		'table_name' => 'locaux',
                'status' => 0
        	],
            [
                'old_name' => 'type_structure',
                'new_name' => 'Structures',
                'table_name' => 'structures',
                'status' => 0
            ],
            /*[
                'old_name' => 'RI',
                'new_name' => 'RI',
                'table_name' => 'structures',
                'status' => 0
            ],*/
            [
                'old_name' => 'type_document',
                'new_name' => 'Type de document',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'date_debut',
                'new_name' => 'Date de début',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'date_signature',
                'new_name' => 'Date de signature',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'date_fin',
                'new_name' => 'Date de fin',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'duree_ini',
                'new_name' => 'Durée initiale',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'tacite_reconduction',
                'new_name' => 'Reconduction tacite',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'reconduction_description',
                'new_name' => 'Description reconduction',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'clause',
                'new_name' => 'Clause',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'description_clause',
                'new_name' => 'Description clause',
                'table_name' => 'baux',
                'status' => 0
            ],
            [
                'old_name' => 'quantite_site',
                'new_name' => 'Quantité de site',
                'table_name' => 'baux',
                'status' => 0
            ]
            
        ]);
    }
}
