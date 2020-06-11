<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// admin
Route::get('clientes/allshow', 'HomeController@allShow')->name('clientes.allshow');
Route::post('clientes/store', 'HomeController@store')->name('clientes.store');
Route::delete('/cliente/{user}', [
	'uses' => 'HomeController@destroy',
	'as' => 'clientes.destroy'
]);
Route::post('cliente/{user}/changeEstatus', 'HomeController@change_status')
        ->name('clientes.change_status');
Route::put('/cliente/{user}',[
    'uses' => 'HomeController@update',
    'as' => 'clientes.update'
]);