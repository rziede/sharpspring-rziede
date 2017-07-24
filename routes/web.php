<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/
$app->get('login', ['as' => 'login_page', 'uses' => 'LoginController@showLogin']);
$app->post('login', 'LoginController@login');

$app->group(['middleware' => 'auth'], function() use ($app) {
  $app->get('/', function () use ($app) {});
  $app->get('user/notes', ['as' => 'note_dashboard', 'uses' => 'NotesController@showNotes'] );
  $app->get('user/notes/{user_id}', 'NotesController@getNotes');
  $app->post('user/notes','NotesController@saveNote');
  $app->put('user/notes/{id}','NotesController@editNote');
  $app->delete('user/notes/{id}','NotesController@deleteNote');
});
