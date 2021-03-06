<?php

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


Route::post('auth/cadastro', 'Auth\RegisterController@create');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

Route::resource('imovel', 'ImovelController');
Route::get('imovel/finalidade/{id}', 'ImovelController@buscaFinalidade');
Route::get('imovel/tipo/{id}', 'ImovelController@buscaFinalidade');
Route::get('imovel/busca/{idtipo}/{idfinalidade}', 'ImovelController@buscaTipoFinalidade');

Route::resource('estado', 'EstadoController');

Route::resource('rua', 'RuaController', ['except' => ['create', 'edit']]);
Route::get('rua/cep/{cep}', 'RuaController@cep')->name('rua.cep');

Route::resource('bairro', 'BairroController', ['except' => ['create', 'edit']]);
Route::post('bairro/busca', 'BairroController@busca')->name('bairro.busca');

Route::resource('cidade', 'CidadeController', ['except' => ['create', 'edit']]);
Route::post('cidade/busca', 'CidadeController@busca')->name('cidade.busca');

Route::resource('estado', 'EstadoController', ['except' => ['create', 'edit']]);

Route::resource('interesse', 'InteresseController', ['except' => ['create', 'edit']]);
Route::get('interesse/atender', 'InteresseController@atender')->name('interesse.atender');

Route::resource('tipo', 'TipoController', ['except' => ['create', 'edit']]);

Route::resource('finalidade', 'FinalidadeController', ['except' => ['create', 'edit']]);

Route::resource('foto', 'FotoController', ['except' => ['index', 'create', 'edit']]);
Route::get('foto/imovel/{id}', 'FotoController@imovel')->name('foto.imovel');