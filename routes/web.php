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


//-----RUTAS CONTROLADOR DE LOS EJERCICIOS-----
Route::get('/addlesson', 'LessonsController@create');
Route::post('/addlesson', 'LessonsController@store');
Route::get('/addlesson', ['as' => 'addlesson', 'uses' => 'LessonsController@index']);


Route::get('/lessons', 'LessonsController@showAll');
Route::get('/editlesson', 'LessonsController@indexModify');
//Route::post('/lessons', 'LessonsController@showAll');

Route::get('/lesson/{id?}', 'LessonsController@show');

Route::get('/editlesson/{id?}', 'LessonsController@edit');
Route::post('/editlesson/{id?}', 'LessonsController@store');
Route::post('/editlesson/{id?}/delete', 'LessonsController@destroy');

//--para los comentarios de los ejercicios----
Route::get('/getcommentslesson/{id?}', 'LessonsController@showComments');
Route::post('/newcomment', 'LessonsController@newComment');
Route::get('/israted/{id_ejercicio?}/{id_usuario?}', 'LessonsController@isRated');



//-----RUTAS CONTROLADOR DE LOS USUARIOS-----
Route::post('/user/post', 'UsuariosAppController@store');
Route::get('/user/post', 'UsuariosAppController@index');
Route::get('/user/get/{email?}/{pass?}', 'UsuariosAppController@show');
Route::post('/asignprogramtouser', 'UsuariosAppController@asignProgramToUser');

Route::post('/user/update', 'UsuariosAppController@update');
Route::get('/user/update', function () {
    return view('vendor.adminlte.updateusers');
});

Route::get('/user/getprogramasasignados/{id?}', 'UsuariosAppController@showProgramasAsignados');
Route::get('/user/getprogramascreados/{id?}', 'UsuariosAppController@showProgramasCreados');

Route::post('/user/changeProfileImg', 'UsuariosAppController@changeImgProfile');

Route::get('/user/changeProfileImg', 'UsuariosAppController@index2');

Route::get('/user/getdudascreadas/{id?}', 'UsuariosAppController@showDoubt');
Route::get('/getdudas/', 'UsuariosAppController@showAllDoubts');
Route::post('/user/storedoubt', 'UsuariosAppController@newDoubtToUser');
Route::post('/user/storeresponde', 'UsuariosAppController@newResponseToUser');




//-----RUTAS CONTROLADOR DE LOS PROGRAMAS-----
Route::get('/addprogram', ['as' => 'addprogram', 'uses' => 'ProgramsController@index']);
Route::post('/addprogram', 'ProgramsController@store');
Route::get('/programsdefault', 'ProgramsController@showAllDefault');
Route::get('/programsusuario', 'ProgramsController@showAllUsers');
Route::get('/programdefault/getlessons/{id?}', 'ProgramsController@showLessons');
Route::get('/editprogram', 'ProgramsController@indexModify');
Route::get('/editprogram/{id?}', 'ProgramsController@edit');
Route::post('/editprogram/{id?}/delete', 'ProgramsController@destroy');


//Route::get('/program/{id?}', 'ProgramsController@show');


Route::post('/adduserprogram', 'ProgramsController@storeUserProgram');



Route::get('/users', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
