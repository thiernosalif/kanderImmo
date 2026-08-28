<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
Route::get('/home', 'HomeController@index')->name('home');
    /**
     * Route pour locataire
     */

    Route::get('/locataires', 'LocataireController@index')->name('locataires.index');
    Route::get('locataires/export', 'LocataireController@export')->name('locataires.export');
    Route::get('locataire/create', 'LocataireController@create')->name('locataires.create');
    Route::post('locataire/store', 'LocataireController@store')->name('locataires.store');
    Route::get('locataire/{locataire}/edit', 'LocataireController@edit')->name('locataires.edit');
    Route::put('locataire/{locataire}/update', 'LocataireController@update')->name('locataires.update');
    Route::get('locataire/delete/{id}', 'LocataireController@destroy')->name('locataires.delete');

    /**
     * Routes pour Proprietaire
     */

    Route::get('/proprietaires', 'ProprioController@index')->name('proprietaires.index');
    Route::get('proprietaires/create', 'ProprioController@create')->name('proprietaires.create');
    Route::get('proprietaires/{proprietaire}/edit', 'ProprioController@edit')->name('proprietaires.edit');
    Route::put('proprietaires/{proprietaire}/update', 'ProprioController@update')->name('proprietaires.update');
    Route::post('proprietaires/store', 'ProprioController@store')->name('proprietaires.store');
    Route::get('proprietaires/delete/{id}', 'ProprioController@destroy')->name('proprietaires.delete');

    /**
     * Routes pour Reclamations
     */

    Route::get('/reclamations', 'ReclamationController@index')->name('reclamations.index');
    Route::get('reclamations/create', 'ReclamationController@create')->name('reclamations.create');
    Route::post('reclamations/store', 'ReclamationController@store')->name('reclamations.store');

    /**
     * Route pour bien
     */
    Route::get('/biens', 'BienController@index')->name('biens.index');
    Route::get('biens/create', 'BienController@create')->name('biens.create');
    Route::post('biens/store', 'BienController@store')->name('biens.store');
    Route::get('biens/{bien}/edit', 'BienController@edit')->name('biens.edit');
    Route::put('biens/{bien}/update', 'BienController@update')->name('biens.update');
    Route::get('biens/delete/{id}', 'BienController@destroy')->name('biens.delete');

    /**
     * Route pour articles
     */
    Route::get('/articles', 'ArticleController@index')->name('articles.index');
    Route::get('articles/create', 'ArticleController@create')->name('articles.create');
    Route::post('articles/store', 'ArticleController@store')->name('articles.store');
    Route::get('articles/{article}/edit', 'ArticleController@edit')->name('articles.edit');
    Route::put('articles/{article}/update', 'ArticleController@update')->name('articles.update');
    Route::get('articles/delete/{id}', 'ArticleController@destroy')->name('articles.delete');

    /**
     * Route pour reglement
     */
    Route::get('/reglements', 'ReglementController@index')->name('reglements.index');
    Route::get('reglements/create/{id}', 'ReglementController@create')->name('reglements.create');
    Route::post('reglements/store', 'ReglementController@store')->name('reglements.store');
    Route::get('reglements/{reglement}/edit', 'ReglementController@edit')->name('reglements.edit');
    Route::put('reglements/{reglement}/update', 'ReglementController@update')->name('reglements.update');
    Route::post('/store','ReglementController@store')->name('store');

    /**
     * Route pour comptabilite
     */
    Route::get('/comptabilites/{id}', 'ComptabiliteController@index')->name('comptabilites.index');

    Route::post('comptabilites/debiter', 'ComptabiliteController@debiter')->name('comptabilites.debiter');
    Route::post('comptabilites/crediter', 'ComptabiliteController@crediter')->name('comptabilites.crediter');
  //  Route::post('/store','ReglementController@store')->name('store');

    /**
     * Route pour facture
     */
    Route::get('/factures/{id}', 'FactureController@index')->name('factures.index');

});
