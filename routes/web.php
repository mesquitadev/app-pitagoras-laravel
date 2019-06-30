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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){
    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //Requisições
    Route::get('/solicitar', 'DashboardController@index')->name('request.index');
    Route::get('/solicitar/novo', 'DashboardController@store')->name('request.store');

    //Chaves
    Route::get('/chaves', 'KeyController@index')->name('key.index');
    Route::get('/chaves/cadastrar', 'KeyController@create')->name('key.create');
    Route::post('/chaves/cadastrar/store', 'KeyController@store')->name('key.store');
    Route::get('/chaves/info/{barcode}', 'KeyController@info')->name('key.info');

    //Tipos de Chave
    Route::get('/chaves/tipos', 'TypeController@index')->name('type-key.index');
    Route::get('/chaves/tipos/novo', 'TypeController@create')->name('type-key.create');
    Route::post('/chaves/tipos/store', 'TypeController@store')->name('type-key.store');

    //Requisição
    Route::get('/chaves/solicitar', 'RequestController@create')->name('request.create');
    Route::post('/chaves/store', 'RequestController@store')->name('request.store');

    //Solicitantes
    Route::get('/solicitantes', 'RequestUsersController@index')->name('request-user.index');
    Route::get('/solicitantes/cadastrar', 'RequestUsersController@index')->name('request-user.create');
    Route::post('/solicitantes/cadastrar/store', 'RequestUsersController@store')->name('request-user.store');
    //Informações pela url
    Route::get('/solicitantes/info/{cpf}', 'RequestUsersController@info')->name('request-users.info');


    //Setores
    Route::get('/setores', 'SectorController@index')->name('sector.index');
    Route::get('/setores/cadastrar', 'SectorController@create')->name('sector.create');
    Route::post('/setores/store', 'SectorController@store')->name('sector.store');
    Route::get('/setores/info/{barcode}', 'KeyController@info')->name('sector.info');
});
Route::get('/home', 'HomeController@index')->name('home');
