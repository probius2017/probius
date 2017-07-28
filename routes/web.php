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

  

  //route pour l'autocomplétion/recherche
  Route::get('{page}/{info}/recherche-ville', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheVille');

  Route::get('{page}/{info}/recherche-ad', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheAd');

  Route::get('{page}/{info}/recherche-immat', 'Admin\FonctionsLocauxController@autocomplete')->name('rechercheImmat');

  //Route pour les filtres
  Route::get('{page}/{info}/filters', 'Admin\FonctionsLocauxController@filters')->name('filters');

  Route::post('{page}/{info}/updateColonnes', 'Admin\FonctionsLocauxController@updateColumns')->name('updateColumns');

  Route::any('{page}/{info}/cloture/{id}', 'Admin\FonctionsLocauxController@clotureSinistre')->name('clotureSinistre');



  Route::resource('locaux/bail', 'Admin\BauxController');

  //Export import Excel 
  Route::any('downloadExcel/{type}', 'Admin\importExportController@downloadExcel');

  //Création nouveau local
  Route::get('createLocal', 'Admin\CreateLocalController@create')->name('createLocal');
  Route::post('storeLocal', 'Admin\CreateLocalController@store')->name('storeLocal');
  

  /*-------------------------------------------------------------*/

  //Route::any('/locauxInf25RI', 'Admin\SearchController@filterByCity')->name('filterCity');
 
    /*Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('questionnaire', 'Admin\QuestionnaireController');*/

    /*Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');*/
});


