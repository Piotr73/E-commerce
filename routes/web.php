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


Route::get('/','HomeController@index');

Route::post('/index','HomeController@prueba');
/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index');    
    Route::get('/listado_usuarios', 'UsuariosController@listado_usuarios');
    Route::get('/usuarios/usuario', 'UsuariosController@index');
    Route::post('crear_usuario', 'UsuariosController@crear_usuario');
    Route::post('editar_usuario', 'UsuariosController@editar_usuario');
    Route::post('buscar_usuario', 'UsuariosController@buscar_usuario');
    Route::post('borrar_usuario', 'UsuariosController@borrar_usuario');
    Route::post('editar_acceso', 'UsuariosController@editar_acceso');
  

    Route::post('crear_rol', 'UsuariosController@crear_rol');
    Route::post('crear_permiso', 'UsuariosController@crear_permiso');
    Route::post('asignar_permiso', 'UsuariosController@asignar_permiso');
    Route::get('quitar_permiso/{idrol}/{idper}', 'UsuariosController@quitar_permiso');
    Route::post('usuarios/usuario/{id?}/listarpermisos','UsuariosController@ListarPermisos');
    Route::post('usuarios/usuario/{id?}/listarpermisosgb','UsuariosController@ListarPermisosGrabados');
    Route::post('usuarios/usuario/{id?}/listarpermiso','UsuariosController@ListarPermiso');
    Route::post('usuarios/usuario/{id?}/agregarpermiso','UsuariosController@asignar_permiso');
    Route::post('usuarios/usuario/crearpermiso','UsuariosController@crear_permiso');
    Route::post('usuarios/usuario/quitarpermiso','UsuariosController@quitar_permiso');
    
    
    Route::get('form_nuevo_usuario', 'UsuariosController@form_nuevo_usuario');
    Route::get('form_nuevo_rol', 'UsuariosController@form_nuevo_rol');
    Route::get('form_nuevo_permiso', 'UsuariosController@form_nuevo_permiso');
    Route::get('form_editar_usuario/{id}', 'UsuariosController@form_editar_usuario');
    Route::get('confirmacion_borrado_usuario/{idusuario}', 'UsuariosController@confirmacion_borrado_usuario');
    Route::get('asignar_rol/{idusu}/{idrol}', 'UsuariosController@asignar_rol');
    Route::get('quitar_rol/{idusu}/{idrol}', 'UsuariosController@quitar_rol');
    Route::get('form_borrado_usuario/{idusu}', 'UsuariosController@form_borrado_usuario');
    Route::get('borrar_rol/{idrol}', 'UsuariosController@borrar_rol');
    Route::post('usuarios/usuario/agregarrol','UsuariosController@crear_rol');

});

Route::group(['prefix' => 'usuarios'], function () {
    Route::resource('usuario','UsuariosController');
});

Route::group(['prefix' => 'personas'], function () {
    Route::resource('trabajador','PersonaController');
    Route::resource('cliente','ClienteController');
});

Route::get('/personas/trabajador', 'PersonaController@index');
Route::get('personal/gettrabajadoresInfo','PersonaController@get_trabajador_info');
Route::get('listatrabajadores/{page?}','PersonaController@listatrabajadores');
Route::get('personal/gettrabajadoresinfosearch','PersonaController@gettrabajadoresinfosearch');

Route::get('/personas/cliente', 'ClienteController@index');
Route::get('personal/getclientesInfo','ClienteController@get_cliente_info');
Route::get('listaclientes/{page?}','ClienteController@listaclientes');
Route::get('personal/getclientesinfosearch','ClienteController@getclientesinfosearch');


Route::get('/usuarios/usuario', 'UsuariosController@index');
Route::get('usuario/getusuariosInfo','UsuariosController@get_usuario_info');
Route::get('listausuario/{page?}','UsuariosController@listausuarios');
Route::get('usuario/getusuariosinfosearch','UsuariosController@getusuariosinfosearch');
Route::get('form_editar_usuario/{id}', 'UsuariosController@edit');
Route::post('usuarios/usuario/{id}', 'UsuariosController@destroy');

Route::post('usuarios/usuario/{id?}/eliminarusuario','UsuariosController@Eliminarusuario');

/**************Roles************************/
Route::post('usuarios/usuario/agregarrol','UsuariosController@crear_rol');


/**********Permisos ***********************/
Route::post('usuarios/usuario/{id?}/listarpermisos','UsuariosController@ListarPermisos');
Route::post('usuarios/usuario/{id?}/listarpermisosgb','UsuariosController@ListarPermisosGrabados');
Route::post('usuarios/usuario/{id?}/agregarpermiso','UsuariosController@asignar_permiso');
Route::post('usuarios/usuario/crearpermiso','UsuariosController@crear_permiso');
Route::post('usuarios/usuario/quitarpermiso','UsuariosController@quitar_permiso');


/*******Almacen *********/

Route::group(['prefix'=>'almacen'],function (){
    Route::resource('marca','MarcaController');
    Route::resource('categoria','CategoriaController');
    Route::resource('modelo','ModeloController');
    Route::resource('producto','ProductoController');
});


Route::get('/almacen/marca', 'MarcaController@index');
Route::get('marca/getmarcasInfo','MarcaController@get_marca_info');
Route::get('listamarcas/{page?}','MarcaController@listamarcas');
Route::get('marca/getmarcasinfosearch','MarcaController@getmarcasinfosearch');


/*Categoria*/
Route::get('/almacen/categoria', 'CategoriaController@index');
Route::get('categoria/getcategoriasInfo','CategoriaController@get_categoria_info');
Route::get('listacategorias/{page?}','CategoriaController@listacategorias');
Route::get('categoria/getcategoriasinfosearch','CategoriaController@getcategoriasinfosearch');
Route::get('categoria/prueba','CategoriaController@NuevaCategoria');
Route::get('categoria/prueba/{id?}','CategoriaController@ObtenerCategorias');
Route::post('/almacen/categoria','CategoriaController@RegistrarCategoria');


/*Modelo */
Route::get('/almacen/modelo', 'ModeloController@index');
Route::get('modelo/getmodelosInfo','ModeloController@get_modelo_info');
Route::get('listamodelos/{page?}','ModeloController@listamodelos');
Route::get('modelo/getmodelosinfosearch','ModeloController@getmodelosinfosearch');

/*Producto*/
Route::get('/almacen/producto', 'ProductoController@index');
Route::get('producto/getproductosInfo','ProductoController@get_producto_info');
Route::get('listaproductos/{page?}','ProductoController@listaproductos');
Route::get('producto/getproductosinfosearch','ProductoController@getproductosinfosearch');
Route::get('almacen/producto/{id?}/stock','ProductoController@stock');
Route::post('almacen/producto/{id?}/UpdStock','ProductoController@UpdStock');

Route::get('form_nuevo_producto', 'ProductoController@form_nuevo_producto');
Route::post('/almacen/producto/uploadedit/{id?}','uploadcontroller@uploadedit');
Route::get('fotos/{id?}','ProductoController@mostrarimagen');

/**Traer datos de Stock */
Route::get('almacen/producto/{id?}/stock','ProductoController@stock');
Route::post('almacen/producto/{id?}/UpdStock','ProductoController@UpdStock');


Route::get('/{id}/{image}', function($image = null,$id=null)
{
    $path = storage_path().'/app/'.$id.'/'.$image;
    if (file_exists($path)) { 
        return response()->file($path);
    }
});