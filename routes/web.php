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

Route::get('/show', 'Crudgenerater@showTables');
Route::get('/describ', 'Crudgenerater@describTable');
Route::get('/showCiudad','UsuariosController@ciudades');
Route::post('/showLocalidad','UsuariosController@localidad');
Route::post('/showBarrio','UsuariosController@barrio');
Route::post('/savecliente','UsuariosController@addCliente');
Route::get('/getcategoryp', 'ProductosController@categoriaproductos');
Route::get('/getpclientes', 'ProductosController@productosClientes');
Route::post('/clientesdistribuidor','ProductosController@Clientedistribuidor');
Route::post('/addorden','Ordenes_de_compraController@addCompra');
Route::post('/ShoWorden','Ordenes_de_compraController@showOC');
Route::post('/totalventas','UsuariosController@consultaventasDia');
Route::post('/ventaspesos','UsuariosController@consultaventaspesos');
Route::post('/login','UsuariosController@autenticar');
Route::get('/adminclientes','UsuariosController@consultaClientes');
Route::post('/EditOrden','Ordenes_de_compraController@edit');
Route::post('/Deleteorden','Ordenes_de_compraController@delete');
Route::post('/aprobarod','Ordenes_de_compraController@aprobar_ocompra');



//barrio
/*add*/


