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

Route::resource('imovel', 'ImovelController');

Route::resource('estado', 'EstadoController');

Route::resource('rua', 'RuaController', ['except' => ['create', 'edit']]);
Route::get('rua/cep/{cep}', 'RuaController@cep')->name('rua.cep');

Route::resource('bairro', 'BairroController', ['except' => ['create', 'edit']]);
Route::post('bairro/busca', 'BairroController@busca')->name('bairro.busca');

Route::resource('cidade', 'CidadeController', ['except' => ['create', 'edit']]);
Route::post('cidade/busca', 'CidadeController@busca')->name('cidade.busca');

Route::resource('estado', 'EstadoController', ['except' => ['create', 'edit']]);

Route::resource('interesse', 'InteresseController', ['except' => ['create', 'edit']]);

Route::resource('tipo', 'TipoController', ['except' => ['create', 'edit']]);

Route::resource('finalidade', 'InteresseController', ['except' => ['create', 'edit']]);