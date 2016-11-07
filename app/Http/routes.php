<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(array('prefix' => 'backend'), function(){

	// Authentication Routes...
    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    $this->get('register', 'Auth\AuthController@showRegistrationForm');
    $this->post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    $this->post('password/reset', 'Auth\PasswordController@reset');

    Route::group(array('before' => 'auth'), function(){

		Route::get('/', 'BackendHomeController@index');

		/***************************************************************************************************************************
        
         ADMINISTRACION DE PARTIDOS
        
        ****************************************************************************************************************************/

        // Esta instruccion indica que las rutas deben tener el prefijo "backend/partidos", ej: backend/partidos/listaPartidos
        Route::group(array('prefix' => 'partidos'), function(){
            
            // Lista de Partidos
            Route::match(array('GET', 'POST'), 'listaPartidos', 'BackendPartidosController@index');
            Route::match(array('GET', 'POST'), '', 'BackendPartidosController@index');

            // Detalle de Partido
            //Route::get('detallePartido/{id?}', 'BackendPartidosController@show');

            // Agregar Partido
            Route::get('agregarPartido', 'BackendPartidosController@create');
            Route::post('agregarPartido', 'BackendPartidosController@store');
            
            // Editar Partido
            Route::get('editarPartido/{id?}', 'BackendPartidosController@edit');
            Route::post('editarPartido/{id?}', 'BackendPartidosController@update');

            // Eliminar Partido
            //Route::get('eliminarPartido/{id?}', 'BackendPartidosController@destroy');

            // Cambiar Estado de Partido
            Route::get('cambiaEstadoPartido/{id?}', 'BackendPartidosController@cambiaEstado');
        });

        /***************************************************************************************************************************
        
         ADMINISTRACION DE CANDIDATOS
        
        ****************************************************************************************************************************/

        // Esta instruccion indica que las rutas deben tener el prefijo "backend/candidatos", ej: backend/candidatos/listaCandidatos
        Route::group(array('prefix' => 'candidatos'), function(){
            
            // Lista de Candidatos
            Route::match(array('GET', 'POST'), 'listaCandidatos', 'BackendCandidatosController@index');
            Route::match(array('GET', 'POST'), '', 'BackendCandidatosController@index');

            // Detalle de Candidato
            //Route::get('detalleCandidato/{id?}', 'BackendCandidatosController@show');

            // Agregar Candidato
            Route::get('agregarCandidato', 'BackendCandidatosController@create');
            Route::post('agregarCandidato', 'BackendCandidatosController@store');
            
            // Editar Candidato
            Route::get('editarCandidato/{id?}', 'BackendCandidatosController@edit');
            Route::post('editarCandidato/{id?}', 'BackendCandidatosController@update');

            // Eliminar Candidato
            //Route::get('eliminarCandidato/{id?}', 'BackendCandidatosController@destroy');

            // Cambiar Estado de Candidato
            Route::get('cambiaEstadoCandidato/{id?}', 'BackendCandidatosController@cambiaEstado');
        });

        /***************************************************************************************************************************
        
         ADMINISTRACION DE PREGUNTAS
        
        ****************************************************************************************************************************/

        // Esta instruccion indica que las rutas deben tener el prefijo "backend/preguntas", ej: backend/preguntas/listaPreguntas
        Route::group(array('prefix' => 'preguntas'), function(){
            
            // Lista de preguntas
            Route::match(array('GET', 'POST'), 'listaPreguntas', 'BackendPreguntasController@index');
            Route::match(array('GET', 'POST'), '', 'BackendPreguntasController@index');

            // Detalle de Pregunta
            //Route::get('detallePregunta/{id?}', 'BackendPreguntasController@show');

            // Agregar Pregunta
            Route::get('agregarPregunta', 'BackendPreguntasController@create');
            Route::post('agregarPregunta', 'BackendPreguntasController@store');
            
            // Editar Pregunta
            Route::get('editarPregunta/{id?}', 'BackendPreguntasController@edit');
            Route::post('editarPregunta/{id?}', 'BackendPreguntasController@update');

            // Eliminar Pregunta
            //Route::get('eliminarPregunta/{id?}', 'BackendPreguntasController@destroy');

            // Cambiar Estado de Pregunta
            Route::get('cambiaEstadoPregunta/{id?}', 'BackendPreguntasController@cambiaEstado');
        });

        /***************************************************************************************************************************
        
         ADMINISTRACION DE RESPUESTAS
        
        ****************************************************************************************************************************/

        // Esta instruccion indica que las rutas deben tener el prefijo "backend/respuestas", ej: backend/respuestas/listaRespuestas
        Route::group(array('prefix' => 'respuestas'), function(){
            
            // Lista de respuestas
            Route::match(array('GET', 'POST'), 'listaRespuestas', 'BackendRespuestasController@index');
            Route::match(array('GET', 'POST'), '', 'BackendRespuestasController@index');

            // Detalle de Respuesta
            //Route::get('detalleRespuesta/{id?}', 'BackendRespuestasController@show');

            // Agregar Respuesta
            Route::get('agregarRespuesta', 'BackendRespuestasController@create');
            Route::post('agregarRespuesta', 'BackendRespuestasController@store');
            
            // Editar Respuesta
            Route::get('editarRespuesta/{id?}', 'BackendRespuestasController@edit');
            Route::post('editarRespuesta/{id?}', 'BackendRespuestasController@update');

            // Eliminar Respuesta
            //Route::get('eliminarRespuesta/{id?}', 'BackendRespuestasController@destroy');

            // Cambiar Estado de Respuesta
            Route::get('cambiaEstadoRespuesta/{id?}', 'BackendRespuestasController@cambiaEstado');
        });

	
	});

});


Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@report');

Route::get('juego-login', 'HomeController@create');
Route::post('juego-login', 'HomeController@store');

Route::get('juego', 'HomeController@viewJuego');
Route::post('juego', 'HomeController@storeJuego');

Route::get('juego-resultado', 'HomeController@resultado');

Route::get('frente-a-frente', 'HomeController@frenteafrente');
Route::post('frente-a-frente', 'HomeController@showfrenteafrente');


Route::post('excel','ExcelController@index');



