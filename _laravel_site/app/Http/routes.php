<?php

Route::get('/', 'PrincipalController@index');
Route::put('/', 'PrincipalController@index');
Route::get('/resultados', 'PrincipalController@resultados');
Route::post('/resultados', 'PrincipalController@resultados');

Route::get('/gerar-indice/passo-1', 'IndiceInvertidoController@passo1');
Route::post('/gerar-indice/passo-2', 'IndiceInvertidoController@passo2');
Route::post('/gerar-indice/passo-3', 'IndiceInvertidoController@passo3');
Route::post('/gerar-indice/passo-4', 'IndiceInvertidoController@passo4');
Route::post('/gerar-indice/fim', 'IndiceInvertidoController@fim');

Route::get('colecao/{colecao}/{id}', 'IndiceInvertidoController@colecao');		//Importante para a exibição de documentos
Route::get('toklog', 'IndiceInvertidoController@toklog');			//Importante para a exibição da barra de progresso

Route::get('/migrate', function () {
    Artisan::call("migrate:refresh");
    echo "Migrate refresh!<br>";
    Artisan::call("db:seed");
    echo "Database seeding!";
});
