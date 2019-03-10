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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
    
    Route::get('expedientes/all','ExpedientesController@all');
    Route::post('expedientes/{expediente}/ayudas', 'AyudaExpedienteController');
    Route::post('expedientes/{expediente}/restore','ExpedientesController@restore');

    Route::resource('expedientes','ExpedientesController');

    Route::get('personas/{persona}/historico','HistoricoController@show');

    Route::resource('personas','PersonasController');

    Route::get('usuarios/verUsuarios','UsuariosController@verUsuarios')->name('verUsuarios');
    Route::resource('usuarios','UsuariosController');

    Route::resource('referentes','ReferentesController');

    Route::get('ayudas/verAyudas','AyudasController@verAyudas')->name('verAyudas');
    Route::resource('ayudas','AyudasController');

    Route::resource('visitas', 'VisitasController');

    Route::get('inspectores/all','InspectoresController@all');   
    Route::resource('inspectores', 'InspectoresController');
        
    Route::get('transacciones/all','HomeController@all');    
});