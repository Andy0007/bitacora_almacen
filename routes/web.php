<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdministradorController;

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

/************************************ */
/************************************ */
//Rutas antes del Login
Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [LoginController::class, 'login'])
    ->name('home.login');

Route::get('/home', [LoginController::class, 'destroy'])    
    ->name('home.destroy');
//Terminan rutas antes del Login
/************************************ */
/************************************ */


/************************************ */
/************************************ */
//******** Ruta Administrador ********//
/************************************ */
/************************************ */
Route::controller(AdministradorController::class)->group(function(){

    Route::get('/admin_index','index_admin')
        ->middleware('auth.admin')
        ->name('admin.index');

    Route::get('/resetear_pass/{id}', 'password')
        ->middleware('auth.admin')
        ->name('admin.pass');

    Route::post('/resetear_pass', 'actualizar_password')
        ->middleware('auth.admin')
        ->name('admin.actualizar_pass');

    /**********************/
    /**********************/
    /****** Usuarios ******/
    Route::get('/usuarios_index', 'users_index')
        ->middleware('auth.admin')
        ->name('admin.users_index');

    Route::get('/usuario_nuevo', 'users_nuevo')
        ->middleware('auth.admin')
        ->name('usuarios.nuevo');

    Route::post('/usuario_crear', 'users_crear')
        ->middleware('auth.admin')
        ->name('usuarios.crear');

    Route::get('/editar_usuarios/{id}', 'editar')
        ->middleware('auth.admin')
        ->name('usuarios.editar');

    Route::put('/actualizar_usuarios', 'actualizar')
        ->middleware('auth.admin')
        ->name('usuarios.actualizar');

    Route::get('/inactivar_usuarios/{id}', 'inactivar')
        ->middleware('auth.admin')
        ->name('usuarios.inactivar');

    Route::get('/usuarios_inactivos', 'inactivos')
        ->middleware('auth.admin')
        ->name('usuarios.inactivos');

    /**********************/
    /**********************/
    /******* Grupos *******/
    Route::get('/admin_grupos', 'grupos_admin')
        ->middleware('auth.admin')
        ->name('admin.grupos');

    Route::get('/grupo_nuevo', 'nuevo_grupo')
        ->middleware('auth.admin')
        ->name('grupos.nuevo');

    Route::post('/grupo_crear', 'crear_grupo')
        ->middleware('auth.admin')
        ->name('grupos.crear');

    Route::get('/editar_grupos/{id}', 'editar_grupo')
        ->middleware('auth.admin')
        ->name('grupos.editar');
    
    Route::get('/categorias_grupos/{id}', 'categorias_grupo')
        ->middleware('auth.admin')
        ->name('grupos.categorias');
    
    Route::post('/categorias_grupos', 'categorias_crear_grupo')
        ->middleware('auth.admin')
        ->name('grupos.categoriascrear');
    
    Route::get('/categorias_grupos_default/{id}/{grupo}', 'categorias_default_grupo')
        ->middleware('auth.admin')
        ->name('grupos.categoriasdefault');
    
    Route::post('/actualizar_grupos', 'actualizar_grupo')
        ->name('grupos.actualizar');
    
    Route::get('/inactivar_grupos/{id}', 'inactivar_grupo')
        ->middleware('auth.admin')
        ->name('grupos.inactivar');    

    /****************************/
    /****************************/
    /*********** LDAP ***********/  
    Route::get('/server_ldap', 'server_ldap')
        ->middleware('auth.admin')
        ->name('admin.server_ldap');
        
    Route::post('/editar_ldap', 'editar_ldap')
        ->middleware('auth.admin')
        ->name('admin.editar_ldap');

    Route::get('/probar_ldap', 'probar_ldap')
        ->middleware('auth.admin')
        ->name('admin.probar_ldap');  

    /****************************/
    /****************************/
    /******** Entregas *********/  
    Route::get('/admin_entregas', 'entregas_admin')
        ->middleware('auth.admin')
        ->name('admin.entregas'); 

    Route::get('/entrega_nueva', 'entrega_nueva')
        ->middleware('auth.admin')
        ->name('admin_entrega.nuevo');

    Route::post('/firma_entrega_nueva', 'firma_entrega_nueva')
        ->middleware('auth.admin')
        ->name('admin_firma_entrega.nuevo');

    /****************************/
    /****************************/
    /******** Historial *********/  
        Route::get('/buscar_historial_articulo', 'buscar_historial_articulo')
            ->middleware('auth.admin')
            ->name('resguardo.buscar_historial_articulo');
            
        Route::post('/historial_articulo', 'historial_articulo')
            ->middleware('auth.admin')
            ->name('resguardo.historial_articulo');
    
        Route::get('/buscar_historial_persona', 'buscar_historial_persona')
            ->middleware('auth.admin')
            ->name('resguardo.buscar_historial_persona');
            
        Route::post('/historial_persona', 'historial_persona')
            ->middleware('auth.admin')
            ->name('resguardo.historial_persona');

});


