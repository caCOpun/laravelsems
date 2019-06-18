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


Route::get('/', 'HomeController@index');

Route::get('/dashboard', [
	'as' => 'dashboard',
	'uses' => 'DashboardController@index',
	'middleware' => 'auth'
]);

Route::group(['middleware' => ['auth', 'authorize']], function(){
	Route::resource('users', 'UsersController');
	Route::resource('roles', 'RolesController');
	Route::resource('permissions', 'PermissionsController');
	Route::get('/role_permission', 'RolesPermissionsController@index');
	Route::post('/role_permission', 'RolesPermissionsController@store');


	Route::resource('years', 'YearController', ['except' => ['show']]);
	Route::resource('semesters', 'SemesterController', ['except' => ['show']]);
	Route::resource('subjects', 'SubjectController', ['except' => ['show']]);
	Route::resource('students', 'StudentController');
	Route::resource('checks', 'CheckController',['except' => ['index','show','edit', 'update','delete']]);

	Route::get('students/add-note/{id}/student/{idStudent}', [
		'uses' => 'StudentController@getAddNote',
		'as' => 'students.addNote',
	]);

	Route::post('students/add-note/{id}/student/{idStudent}', [
		'uses' => 'StudentController@postAddNote',
		'as' => 'students.addNote',
	]);

});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
