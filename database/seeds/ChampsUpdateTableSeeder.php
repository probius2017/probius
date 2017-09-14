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
                'old_name' => 'cp_algeco',
                'new_name' => 'Code postal',
                'table_name' => 'algecos',
                'status' => 1
            ],
            [
                'old_name' => 'ville_algeco',
                'new_name' => 'Ville',
                'table_name' => 'algecos',
                'status' => 1

            ],
            [
                'old_name' => 'adresse_algeco',
                'new_name' => 'Adresse',
                'table_name' => 'algecos',
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
        		'new_name' => 'Superficie (m²)',
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
                'new_name' => 'Structure(s)',
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
            ],
            [
                'old_name' => 'volume',
                'new_name' => 'Volume (m3)',
                'table_name' => 'chambresFroides',
                'status' => 1
            ],
            [
                'old_name' => 'type_algeco',
                'new_name' => 'Type algeco',
                'table_name' => 'algecos',
                'status' => 1
            ],
            [
                'old_name' => 'numero_contratV',
                'new_name' => 'Numéro de contrat',
                'table_name' => 'contratV',
                'status' => 0
            ],
            [
                'old_name' => 'ref_macif',
                'new_name' => 'Ref MACIF',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'ref_rdc',
                'new_name' => 'Ref RDC',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'date_reception',
                'new_name' => 'Date réception',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'date_ouverture',
                'new_name' => 'Date ouverture',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'date_sinistre',
                'new_name' => 'Date sinistre',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'ville_sinistre',
                'new_name' => 'Ville',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'ref',
                'new_name' => 'Type sinistre',
                'table_name' => 'type_sinistre',
                'status' => 1
            ],
            [
                'old_name' => 'name_marque',
                'new_name' => 'Véhicule',
                'table_name' => 'marques',
                'status' => 1
            ],
            [
                'old_name' => 'name_modele',
                'new_name' => 'Modele',
                'table_name' => 'modeles',
                'status' => 1
            ],
            [
                'old_name' => 'type',
                'new_name' => 'Type',
                'table_name' => 'categories',
                'status' => 1
            ],
            [
                'old_name' => 'immat',
                'new_name' => 'Immat',
                'table_name' => 'vehicules',
                'status' => 1
            ],
            [
                'old_name' => 'old_immat',
                'new_name' => 'Ancienne Immat',
                'table_name' => 'vehicules',
                'status' => 0
            ],
            [
                'old_name' => 'pmc',
                'new_name' => 'Date PMC',
                'table_name' => 'vehicules',
                'status' => 0
            ],
            [
                'old_name' => 'atp',
                'new_name' => 'Date ATP',
                'table_name' => 'vehicules',
                'status' => 0
            ],
            [
                'old_name' => 'reference',
                'new_name' => 'Garantie(s)',
                'table_name' => 'garanties',
                'status' => 1
            ],


            [
                'old_name' => 'responsabilite',
                'new_name' => 'Responsabilité',
                'table_name' => 'sinistres',
                'status' => 1
            ],
            [
                'old_name' => 'observation',
                'new_name' => 'Observation',
                'table_name' => 'sinistres',
                'status' => 0
            ],
            [
                'old_name' => 'reglement_macif',
                'new_name' => 'Regl MACIF',
                'table_name' => 'sinistres',
                'status' => 0
            ],
            [
                'old_name' => 'franchise',
                'new_name' => 'Franchise',
                'table_name' => 'sinistres',
                'status' => 0
            ],
            [
                'old_name' => 'solde_ad',
                'new_name' => 'Solde AD',
                'table_name' => 'sinistres',
                'status' => 0
            ],
            [
                'old_name' => 'date_cloture',
                'new_name' => 'Date cloture',
                'table_name' => 'sinistres',
                'status' => 0
            ],
            
            //Pour la table Evenements
            [
                'old_name' => 'nom_salle',
                'new_name' => 'Nom salle',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'adresse_event',
                'new_name' => 'Adresse',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'cp_event',
                'new_name' => 'Code postal',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'ville_event',
                'new_name' => 'Ville',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'nom_event',
                'new_name' => 'Nom Evènement',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'type_event',
                'new_name' => 'Type Evènement',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'duree_event',
                'new_name' => 'Durée Evènement',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'statut_event',
                'new_name' => 'Statut (cloturé?)',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'date_demande',
                'new_name' => 'Date demande',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'date_reponse',
                'new_name' => 'Date réponse',
                'table_name' => 'evenements',
                'status' => 1
            ],
            [
                'old_name' => 'remarque',
                'new_name' => 'Remarque',
                'table_name' => 'evenements',
                'status' => 1
            ]

        ]);
    }
}
