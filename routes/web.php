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



Route::get('/api', 'ApiController@index');

Route::post('/api/tasks', 'ApiController@tasks');

Route::post('/api/sprints', 'ApiController@sprints');

Route::post('/api/tasks/close', 'ApiController@closeTasks');

Route::post('/api/sprints/close', 'ApiController@closeSprint');



