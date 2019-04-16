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

//TEST ROUTES
Route::get('/', function () {
    return view('welcome');
});


Route::get('/pruebas/{nombre?}', function($nombre = null){
    $texto = "TEXTO TEXTO TEST";
    return view('pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/animales','PruebasController@index');

Route::get('/testorm','PruebasController@textOrm');

Route::get('/testorm','PruebasController@textOrm');

//API ROUTES
    //RUTAS DE PRUEBA
    Route::get('/usuario/pruebas', 'UserController@pruebas');
    Route::get('/post/pruebas', 'PostController@pruebas');
    Route::get('/categoria/pruebas', 'CategoryController@pruebas');

//Rutas controlador de usuario
Route::post('api/register', 'UserController@register');
Route::post('api/login', 'UserController@login');
Route::post('api/user/update', 'UserController@update');