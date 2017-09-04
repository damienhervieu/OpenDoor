<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('before' => 'auth|firstLogin|authRemember', 'uses' => 'HomeController@getHome'));

Route::post('/open-door', array('before' => 'csrf', 'uses' => 'HomeController@postHome'));

Route::get('/password-change', array('before' => 'auth', 'uses' => 'AuthController@getPasswordChange'));

Route::post('/password-change', array('before' => 'csrf', 'uses' => 'AuthController@postPasswordChange'));

Route::get('/login', array('before' => 'guest', 'uses' => 'AuthController@getLogin'));

Route::post('/login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));

Route::get('/logout', array('before' => 'auth', 'uses' => 'AuthController@getLogout'));

Route::get('/open-door-logs', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getOpenDoorLogs'));

Route::get('/complete-logs', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getCompleteLogs'));

Route::get('/manage-users', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getManageUsers'));

Route::get('/manage-users/add-user', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getAddUser'));

Route::post('/manage-users/add-user', array('before' => 'csrf', 'uses' => 'UserManagementController@postAddUser'));

Route::get('/manage-users/modify/{id}', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getModify'));

Route::post('/manage-users/modify/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postModify'));

Route::get('/manage-users/reset-password/{id}', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getResetPassword'));

Route::post('/manage-users/reset-password/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postResetPassword'));

Route::get('/manage-users/delete/{id}', array('before' => 'auth|isAdmin|firstLogin|authRemember', 'uses' => 'UserManagementController@getDelete'));

Route::post('/manage-users/delete/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postDelete'));