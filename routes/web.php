<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'HomeController@index')->name('home');

/*
  |--------------------------------------------------------------------------
  | Authentication Routes
  |--------------------------------------------------------------------------
 */

Route::any('/auth/login', 'AuthController@authenticate')->name('login');

Route::get('/auth/logout', 'AuthController@logout')->name('logout');

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
 */

// Route::pattern('structure', '[0-9]+');
// Route::pattern('ville', '[0-9]+');
// Route::pattern('ad', '[0-9]+');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

  Route::get('/accueil', 'Admin\AdminController@adminIndex')->name('home');

  //route pour le blocs contrat socle
  Route::resource('{page}/{info}/listeLocaux', 'Admin\LocauxInf25Controller');

  //route pour le blocs aci >=50
  Route::resource('{page}/{info}/listeACI', 'Admin\AciSup50Controller');

  //route pour le blocs aci RCPRO
  Route::resource('{page}/{info}/listeAciRCPRO', 'Admin\AciRCPROController');

  //route pour le blocs entrepots >25RI
  Route::resource('{page}/{info}/listeEntrepots', 'Admin\EntrepotsController');

  //route pour le blocs entrepots >25RI
  Route::resource('{page}/{info}/listeBiensAN', 'Admin\BiensANController');

  //route pour le blocs Chambres froides
  Route::resource('{page}/{info}/listeChambresFroides', 'Admin\ChambreFController');

  //route pour le blocs Algécos
  Route::resource('{page}/{info}/listeAlgecos', 'Admin\AlgecosController');

  //route pour le blocs véhicules
  Route::resource('{page}/{info}/listeVehicules', 'Admin\VehiculesController');

  //route pour le blocs sinistres Masse et Véhicules
  Route::resource('{page}/{info}/listeSinistresVehicules', 'Admin\SinistresVehiculesController');

  Route::resource('{page}/{info}/listeSinistresMasse', 'Admin\SinistresMasseController');

  //route pour le blocs évènements
  Route::resource('{page}/{info}/listeEvenements', 'Admin\EvenementsController');

  //routes pour les historiques
  Route::get('{page}/{info}/listeHistoriqueLocaux', 'Admin\HistoriquesController@historiqueLocaux')->name('historiqueLocaux');

  Route::get('{page}/{info}/listeHistoriqueVehicules', 'Admin\HistoriquesController@historiqueVehicules')->name('historiqueVehicules');

  //route pour l'autocomplétion/recherche
  Route::get('{page}/{info}/recherche-ville', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheVille');

  Route::get('{page}/{info}/recherche-ad', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheAd');

  Route::get('{page}/{info}/recherche-immat', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheImmat');

  Route::get('{page}/{info}/recherche-ref', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheRef');

  Route::get('{page}/{info}/recherche-villeSinistre', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheVilleSinistre');

  Route::get('{page}/{info}/recherche-villeEvent', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheVilleEvent');

  Route::get('{page}/{info}/recherche-nomEvent', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheNomEvent');

  //Route pour les filtres et update colonnes
  Route::get('{page}/{info}/filters', 'Admin\FonctionsLocauxController@filters')->name('filters');

  Route::post('filtersByRef', 'Admin\FonctionsLocauxController@filterSinistresByref')->name('filterSinistresByref');

  Route::post('{page}/{info}/updateColonnes', 'Admin\FonctionsLocauxController@updateColumns')->name('updateColumns');

  //route cloture sinistre
  Route::any('{page}/{info}/cloture/{id}', 'Admin\FonctionsLocauxController@clotureSinistre')->name('clotureSinistre');

  //route liste des ref sinistre par entity
  Route::get('{page}/{info}/liste-ref-sinistres/{id}', 'Admin\FonctionsLocauxController@listeRefSinistresByEntity')->name('listeRefSinistresByEntity');

  Route::resource('locaux/bail', 'Admin\BauxController');

  //Export import Excel 
  Route::any('{page}/{info}/downloadExcel/{type}', 'Admin\importExportController@downloadExcel')->name('downloadExcel');

  //Création nouveau local
  Route::get('{page}/{info}/new', 'Admin\CreateLocalController@create')->name('createLocal');
  Route::post('storeLocal', 'Admin\CreateLocalController@store')->name('storeLocal');
  

  /*-------------------------------------------------------------*/

  //Route::any('/locauxInf25RI', 'Admin\SearchController@filterByCity')->name('filterCity');
 
    /*Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('questionnaire', 'Admin\QuestionnaireController');*/

    /*Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');*/
});


