<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Algeco::class, function (Faker\Generator $faker) {

    $algeco = ['Bungalow', 'Chalet bois'];

    return [
                'type_algeco'       => $algeco[array_rand($algeco)],
                'adresse_algeco'    => $faker->streetAddress,
                'apptEscalier'      => $faker->citySuffix,
                'complementGeographique' => $faker->streetSuffix,
                'ville_algeco'      => $faker->state,
                'cp_algeco'         => $faker->randomNumber(5,false),
                'ad_id'             => rand(1, 119),
                'bail_id'           => rand(1, 10)
            ];
});

$factory->define(App\Models\Local::class, function (Faker\Generator $faker) {

    $erp = [true, false];
    $precaire = [true, false];
    $etatIni = ['Parfait état', 'Remise en état fin de bail'];
    $infoBailleur = ['0', '1', '2'];
    $loyer = ['TVA', 'NET'];
    $prixM2 = 800;
    $partage = [true, false];

    return [
                'adresse_local'     => $faker->streetAddress,
                'apptEscalier'      => $faker->citySuffix,
                'complementGeographique' => $faker->streetSuffix,
                'ville_local'       => $faker->state,
                'cp_local'          => $faker->randomNumber(5,false),
                'superficie'        => $faker->randomNumber(6, false),
                'ERP'               => $erp[array_rand($erp)],
                'precaire'          => $precaire[array_rand($precaire)],
                'etat_ini'          => $etatIni[array_rand($etatIni)],
                'nom_bailleur'      => $faker->lastName,
                'info_bailleur'     => $infoBailleur[array_rand($infoBailleur)],
                'loyer'             => $faker->randomFloat(3, 0,10000),
                'detail_loyer'      => $loyer[array_rand($loyer)],
                'prix_m2'           => $prixM2,
                'pret'              => $faker->randomFloat(3, 0,100000),
                'local_partage'     => $partage[array_rand($partage)],
                'precision_partage' => $faker->text(100),
                'accessibilite'     => $faker->text(100),
                'observation_generale' => $faker->text(200),
                'charge_bailleur'   => $faker->text(100),
                'charge_rdc'        => $faker->text(100),
                'detail_charge'     => $faker->text(200),
                'contenu'           => $faker->randomNumber(5, false),
                'ad_id'             => rand(1, 119),
                'bail_id'           => rand(1, 10),
                'historiqueLocal_id'     => null

            ];
});

$factory->define(App\Models\Bail::class, function (Faker\Generator $faker) {

    $type_contrat = ['>25RI', 'RC PRO', '>50RI', 'FLOTTE'];
    $rand = array_rand ( $type_contrat, 1 );

    $type_doc = ['Bail Civil', 'Bail amphytheotique', 'Bail commercial', 'Conventions', 'Autres'];
    $rand2 = array_rand ( $type_doc, 1 );

    $tacite = array(True, False);

    $clause = array('résolutoire', 'résiliation');

    return [
                'type_document'             => $type_doc[$rand2],
                'date_debut'                => $faker->date,
                'date_fin'                  => $faker->date,
                'date_signature'            => $faker->date,
                'duree_ini'                 => $faker->randomNumber(5, false),
                'tacite_reconduction'       => $tacite[array_rand($tacite)],
                'reconduction_description'  => $faker->realText(150,1),
                'clause'                    => $clause[array_rand($clause)],
                'description_clause'        => $faker->text(150),
                'quantite_site'             => rand(1, 10)
           ];
});

$factory->define(App\Models\Evenement::class, function (Faker\Generator $faker) {

    return [
                'statut_event'     => rand(0, 1),
                'nom_salle'        => $faker->state,
                'nom_event'        => $faker->jobTitle,
                'date_demande'     => $faker->date,
                'date_reponse'     => $faker->date,
                'remarque'         => $faker->text(100)
                //'contrat_id'       => 1
            ];
});