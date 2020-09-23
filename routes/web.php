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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients', 'Clients@index')->name('clients');
Route::get('/client/new', 'Client\NewClient@create')->name('new_client');
Route::get('/client/{id}', 'Clients@show')->name('show_client');
Route::post('/client/new', 'Client\NewClient@insert')->name('ins_client');
Route::get('/client/update/{id}', 'Client\UpdateClient@edit')->name('edit_client');
Route::post('/client/update/{id}', 'Client\UpdateClient@update')->name('update_client');
Route::delete('/client/delete/{id}', 'Client\UpdateClient@destroy')->name('destroy_client');


Route::get('/agendas', 'Agendas@index')->name('agendas');
Route::get('/agendas/week/{week}', 'Agendas@week')->name('agendas_week');
Route::get('/agendas/day/{day}', 'Agendas@day')->name('agendas_day');
Route::get('/agendas/all/{id}', 'Agendas@all')->name('agendas_all');
Route::get('/agenda/new', 'Agenda\NewAgenda@create')->name('new_agenda');
Route::post('/agenda/new', 'Agenda\NewAgenda@insert')->name('ins_agenda');
Route::get('/agenda/update/{id}', 'Agenda\UpdateAgenda@edit')->name('edit_agenda');
Route::post('/agenda/update/{id}', 'Agenda\UpdateAgenda@update')->name('update_agenda');
Route::delete('/agenda/delete/{id}', 'Agenda\UpdateAgenda@destroy')->name('destroy_agenda');

Route::get('/preferences/{id}', 'Preferences@index')->name('preferences');
Route::get('/preferences/new/{id}', 'Preference\NewPreference@create')->name('new_preference');
Route::post('/preferences/new', 'Preference\NewPreference@insert')->name('ins_preference');
Route::delete('/preferences/delete/{id}', 'Preference\UpdatePreference@destroy')->name('destroy_preference');