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
  Route::resource('locauxInf25RI', 'Admin\LocauxInf25Controller');

  //route pour l'autocomplétion/recherche
  Route::get('recherche-ville', 'Admin\SearchController@autocomplete')->name('rechercheVille');

  Route::get('recherche-ad', 'Admin\SearchController@autocomplete')->name('rechercheAd');

  //Route pour les filtres
  Route::get('filters', 'Admin\SearchController@filters')->name('filters');

  Route::post('updateColonnes', 'Admin\LocauxInf25Controller@updateColumns')->name('updateColumns');

  Route::resource('locauxInf25RI/bail', 'Admin\BauxController');

  //Export import Excel 
  Route::any('downloadExcel/{type}', 'Admin\importExportController@downloadExcel');
  

  /*-------------------------------------------------------------*/

  //Route::any('/locauxInf25RI', 'Admin\SearchController@filterByCity')->name('filterCity');
 
    /*Route::resource('question', 'Admin\QuestionController');
    Route::resource('reponse', 'Admin\ReponseController');
    Route::resource('questionnaire', 'Admin\QuestionnaireController');*/

    /*Route::post('question/{id}/test', 'Admin\QuestionController@testQuestion');*/
});


