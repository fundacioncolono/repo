<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('usuariosMobile/comprobarSesion','Api\UsuariosController@comprobarSesion');
Route::get('usuariosMobile/update','Api\UsuariosController@update');

Route::get('personasMobile/update','Api\PersonasController@update');

Route::get('expedientesMobile/index','Api\ExpedientesController@index');

Route::get('visitasMobile/index','Api\VisitasController@index');
Route::get('visitasMobile/store','Api\VisitasController@store');
Route::get('visitasMobile/update','Api\VisitasController@update');

