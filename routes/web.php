<?php

// auth
Route::get('aceso-denegado', function () { return view('partials.access'); });
Auth::routes();
Route::any('register', function () {
	return redirect('/');
});

Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'access'], function () {
        // root
        Route::get('/', 'HomeController@index');

        // quotations
        Route::get('cotizaciones/dataValid', 'QuotationController@dataValid');
        Route::get('cotizaciones', 'QuotationController@indexValid');
        Route::get('cotizaciones/dataClosed', 'QuotationController@dataClosed');
        Route::get('cotizaciones/cerradas', 'QuotationController@indexClosed');
        Route::get('cotizaciones/dataExpired', 'QuotationController@dataExpired');
        Route::get('cotizaciones/caducadas', 'QuotationController@indexExpired');
        Route::get('cotizacion-simple', 'QuotationController@create');
        Route::post('cotizacion-simple', 'QuotationController@store');
        Route::get('eliminar-cotizacion/{id}', 'QuotationController@destroy');
        Route::get('cotizacion-simple/editar/{id}', 'QuotationController@edit');
        Route::put('cotizacion-simple/editar/{id}', 'QuotationController@update');
        Route::get('cotizacion/documentacion/{id}', 'QuotationController@documentation');
        Route::get('cotizacion/factura/{id}', 'QuotationController@bills');
        Route::post('cotizacion/factura/{id}', 'QuotationController@storeBills');

        // users
        Route::get('usuarios', 'UserController@index');
        Route::get('usuarios/datos', 'UserController@data');
        Route::get('crear-usuario', 'UserController@create');
        Route::post('crear-usuario', 'UserController@store');
        Route::get('usuario/editar/{id}', 'UserController@edit');
        Route::put('usuario/editar/{id}', 'UserController@update');
        Route::get('eliminar-usuario/{id}', 'UserController@destroy');

        // deals
        Route::get('negocios/dataProcess', 'DealController@dataProcess');
        Route::get('negocios', 'DealController@indexProcess');
        Route::get('negocios/dataClosed', 'DealController@dataClosed');
        Route::get('negocios/cerrados', 'DealController@indexClosed');
        Route::get('negocios/dataFinalized', 'DealController@dataFinalized');
        Route::get('negocios/facturados', 'DealController@indexFinalized');
        Route::get('nuevo-negocio', 'DealController@create');
        Route::post('nuevo-negocio', 'DealController@store');
        Route::get('eliminar-negocio/{id}', 'DealController@destroy');
        Route::get('negocio/editar/{id}', 'DealController@edit');
        Route::put('negocio/editar/{id}', 'DealController@update');
        Route::get('negocio/documentacion/{id}', 'DealController@documentation');
        Route::get('negocio/buscar', 'ClientController@search');
        Route::get('negocio/cerrar/{id}', 'DealController@closeDealView');
        Route::post('negocio/cerrar/{id}', 'DealController@closeDealStore');
        Route::get('negocio/historial-conversacion/{id}', 'DealController@historyRoomChat');
        Route::get('negocio/reapertura/{id}', 'DealController@changeStateDeal');

        // clients
        Route::get('clientes/datos', 'ClientController@data');
        Route::get('clientes', 'ClientController@index');
        Route::get('crear-cliente', 'ClientController@create');
        Route::post('crear-cliente', 'ClientController@store');
        Route::get('cliente/editar/{id}', 'ClientController@edit');
        Route::put('cliente/editar/{id}', 'ClientController@update');
        Route::get('eliminar-cliente/{id}', 'ClientController@destroy');

        // profile
        Route::get('perfil', 'UserController@perfil');
        Route::get('perfil/foto/{id}', 'UserController@photoavatar');
        Route::put('perfil/foto/{id}', 'UserController@changephoto');

        // chat
        Route::get('chat/{slug}', 'ChatController@show');
        Route::get('chat/mensajes/{id}', 'ChatController@getMessages');
        Route::post('chat/enviar-mensaje/{id}', 'ChatController@sendMessage');
        Route::post('chat/adjuntar/{id}', 'ChatController@uploadFile');
        Route::get('comprobar-mensajes', 'ChatController@checkMessages');
    });
});
