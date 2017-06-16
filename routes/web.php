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


Route::group(['middleware' => 'auth'], function(){
	Route::get('/', function () {
		$usuarioActual = \Auth::user();
		if($usuarioActual->role==1){
			return view('welcome');
		}
		else{
			return view('dep.home');
		}
	});
	Route::get('/home', 'HomeController@index')->name('home');	
	Route::name('nuevoPlato')->get('services/nuevoPlato', 'PlatoController@nuevoPlato');
	Route::name('modificarPlato')->get('services/modificarPlato', 'PlatoController@modificarPlato');
	Route::name('eliminarPlato')->get('services/eliminarPlato', 'PlatoController@eliminarPlato');
	Route::name('menu')->get('services/menu', 'PlatoController@menu');	
	Route::name('historialPedidos')->get('services/historial', 'PedidosController@historial');
	Route::name('reportePedidos')->get('services/reporte', 'PedidosController@reporte');
	Route::name('homeDep')->get('dep/home', 'PedidosController@homeDep');
	Route::name('change')->post('services/change', 'HomeController@changePassword');
});

Auth::routes();

Route::group(['middleware' => 'usuarioAdmin'], function(){
	Route::name('nuevoPlato')->get('services/nuevoPlato', 'PlatoController@nuevoPlato');
	Route::name('modificarPlato')->get('services/modificarPlato', 'PlatoController@modificarPlato');
	Route::name('eliminarPlato')->get('services/eliminarPlato', 'PlatoController@eliminarPlato');	
	Route::name('historialPedidos')->get('services/historial', 'PedidosController@historial');
	Route::name('reportePedidos')->get('services/reporte', 'PedidosController@reporte');
	Route::name('registroUsuarios')->get('services/registro', 'HomeController@registroUsuario');
	Route::name('usuarioAgregado')->get('mensajes/usuarioagregado', 'HomeController@usuarioAgregado');
	Route::name('eliminarUsuario')->get('services/eliminarUsuario', 'HomeController@eliminarUsuario');
	Route::name('delete')->post('delete', 'HomeController@delete');
	Route::name('modificarUsuario')->get('services/modificarUsuario', 'HomeController@modificarUsuario');
	Route::name('editUser')->get('services/editUser/{id}', 'HomeController@edit');
	Route::name('mod')->post('services/mod/{id}', 'HomeController@mod');
	Route::name('perfil')->get('services/perfil', 'HomeController@perfil');
});

Route::group(['middleware' => 'usuarioDependiente'], function(){
	Route::name('homeDep')->get('dep/home', 'PedidosController@homeDep');
	Route::name('menuDep')->get('dep/menu', 'PlatoController@menuDep');
	Route::name('perfilDep')->get('dep/perfil', 'HomeController@perfilDep');
});



