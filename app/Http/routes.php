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

Route::get('/', 'HomeController@home');
Route::auth();
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'profile'], function() {

	Route::get('view', [
		'as' => 'view_profile',
		'uses' => 'ProfileController@viewprofile'

		]);

	Route::get('edit', [
		'as' => 'edit_profile',
		'uses' => 'ProfileController@editProfile'

		]);
});
	
Route::group(['prefix' => '/auth'], function() {

	Route::get('register', [
		'as' => 'get_register',
		'uses' => 'Auth\AuthController@getRegister'

		]);

	Route::post('register', [
		'as' => 'post_register',
		'uses' => 'Auth\AuthController@postRegister'

		]);

	Route::get('login', [
		'as' => 'get_login',
		'uses' => 'Auth\AuthController@getLogin'

		]);

	Route::post('login', [
		'as' => 'post_login',
		'uses' => 'Auth\AuthController@postLogin'

		]);
	
});


Route::group(['prefix' => 'courses'], function() {

	Route::get('view', [
		'as' => 'get_courses',
		'uses' => 'CoursesController@getCourses'

		]);

	Route::get('read/{course}/{chapter}', 'CoursesController@viewReading');

	Route::get('support/{course}/{chapter}', 'CoursesController@supportingCourses');
});


Route::group(['prefix' => 'forum'], function() {

	Route::get('post', [
		'as' => 'get_post',
		'uses' => 'ForumController@getPost'

		]);
	
	Route::post('post', [
		'as' => 'post_question',
		'uses' => 'ForumController@postQuestion'
		]);

	Route::get('show', [
		'as' => 'show_course',
		'uses' => 'ForumController@showCourses'
	]);

	Route::get('view/{course}', 'ForumController@viewQuestion');
	
	Route::get('view/{course}/detail/{slug}/delete/{id}', [
		'as' => 'delete_reply',
		'uses' => 'ForumController@deleteReply'
	]);

	Route::get('view/{course}/detail/{slug}', [
		'as' => 'get_reply',
		'uses' => 'ForumController@detailQuestion'
	]);
	
	Route::post('view/{course}/detail/{slug}',[
		'as' => 'post_reply',
		'uses' => 'ForumController@postReply'
	]);

	

	

});


Route::group(['prefix' => 'assignment'], function() {

	Route::get('post',[
		'as' => 'post_assignment',
		'uses' => 'AssignmentController@getAssignment'
		]);

	Route::post('post',[
		'as' => 'post_assignment',
		'uses' => 'AssignmentController@postAssignment'
		
		]);

	Route::get('show', [
		'as' => 'show_course',
		'uses' => 'AssignmentController@showCourses'
	]);
	
	Route::get('view/{course}', 'AssignmentController@viewAssignment');

	Route::get('view/{course}/detail/{id}', [
		'as' => 'get_assignment',
		'uses' => 'AssignmentController@detailAssignment'
	]);
	
	Route::post('view/{course}/detail/{id}',[
		'as' => 'post_answer',
		'uses' => 'AssignmentController@submitAssignment'
	]);

	Route::get('view/{course}/detail/{id}/post', [
		'as' => 'get_assignment',
		'uses' => 'AssignmentController@detailAssignment'
	]);
	
	Route::post('view/{course}/detail/{id}/post',[
		'as' => 'post_answer',
		'uses' => 'AssignmentController@submitAssignment'
	]);

	
});
