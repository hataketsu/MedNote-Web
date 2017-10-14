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

Route::get('/', 'NoteController@index');


Route::resource('/notes','NoteController');
Route::get('/trash','NoteController@trash');
Route::get('/trash/delete/{id}','NoteController@trash_delete');
Route::get('/trash/restore/{id}','NoteController@trash_restore');


Route::post('/notes/search','NoteController@search');