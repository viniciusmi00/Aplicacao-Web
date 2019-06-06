<?php


/*Home*/
Route::get('/', 'SiteController@index')->name('home');

/* Possibilita o cadastro de uma nova building */
Route::get('registrar', 'BuildingController@registrar');
Route::post('registrar', 'BuildingController@store');


Route::group(['middleware' => ['auth']], function () {

    /* Página principal */
    Route::get('admin/{year?}', 'Admin\AdminController@index')->name('admin.home');

    /* Gestão do usuário */
    Route::get('perfil', 'Admin\AdminController@perfil');
    Route::patch('perfil', 'Admin\AdminController@atualizaPerfil');
    Route::patch('senha', 'Admin\AdminController@atualizaSenha');

    /* ADMINISTRADOR GERAL */
    Route::group(['middleware' => ['verify.access.level:0']], function () {
        /* Edição da building */
        Route::get('buildings', 'BuildingController@index');
        Route::get('building', 'BuildingController@create');
        Route::post('building','BuildingController@store');
        Route::get('building/{id}','BuildingController@edit');
        Route::patch('building/{id}','BuildingController@update');
        Route::delete('building/{id}','BuildingController@destroy');

        Route::get('usuario/{usuario}/building/{building}','UserController@insereVinculo');
        Route::delete('usuario/{usuario}/building/{building}','UserController@removeVinculo');
    });

     /* ADMINISTRADOR DO PRÉDIO */
     Route::group(['middleware' => ['verify.access.level:02']], function () {
        /* Gestão dos usuários */
        Route::get('usuarios', 'UserController@index');
        Route::get('usuario', 'UserController@create');
        Route::post('usuario','UserController@store');
        Route::get('usuario/{id}','UserController@edit');
        Route::patch('usuario/{id}','UserController@update');
        Route::delete('usuario/{id}','UserController@destroy');
    });


    Route::group(['middleware' => ['verify.access.level:03']], function () {
        
        Route::get('accounts', 'AccountController@index');
        Route::get('accounts/novo', 'AccountController@novo');
        Route::post('accounts/salvar','AccountController@salvar');
        Route::get('accounts/{account}/editar','AccountController@editar');
        Route::patch('accounts/{account}','AccountController@atualizar');
        Route::delete('accounts/{account}','AccountController@deletar');
    });

    
    Route::group(['middleware' => ['verify.access.level:02']], function () {
        
        Route::get('rates', 'RateController@index');
        Route::get('rates/novo', 'RateController@novo');
        Route::post('rates/salvar','RateController@salvar');
        Route::get('rates/{rate}/editar','RateController@editar');
        Route::patch('rates/{rate}','RateController@atualizar');
        Route::delete('rates/{rate}','RateController@deletar');
    });

    Route::group(['middleware' => ['verify.access.level:03']], function () {
        
        Route::get('meu-consumo/{year?}/{month?}', 'ResultadosController@meuConsumo');
    
    });

    Route::group(['middleware' => ['verify.access.level:02']], function () {
        
        Route::get('consumo-predio/{year?}/{month?}', 'ResultadosController@consumoPredio');
    
    });



});


Auth::routes();