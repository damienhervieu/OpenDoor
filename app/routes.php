
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

/*
|-----------------------------------------------------------------------------------------------------------------------------------------------|
| The 'before' Filters
|-----------------------------------------------------------------------------------------------------------------------------------------------|
| Before is used to filter the access of each user (you can access the file named filters.php to make your own or change the existing ones) :
|
|
|
| The auth argument is used to know if the user is connected :
| If he's not connected, he's going directly to the /login(GET) route.
|
|
|
| The guest argument is used to know if the user is authenticated :
| If he's already logged in he won't be able to access the /login(GET) route and be redirected to the homepage.
|
|
|
| The firstLogin argument is used to know if the user changed his password after the first connection :
| If he hasn't changed his password yet, he's going directly to the /password-change(GET) route.
|
|
|
| The authRemember argument is used to know if the user logged in via the "Remember Me" feature :
| If, during his last authentication, the user checked the "Remember Me" box, a request will be sent to the "logs" table
| and the log will be "Logged in via Remember Me" instead of "Logged in via email and password".
|
|
|
| The isAdmin argument is used to know the level of permission of the current user : 
| If he's not an admin and just a member, each route that has this argument won't be available to him.
|
|
|
| The csrf argument is used to prevent cross site request forgery (CSRF) attacks :
| If the attack takes place, a fatal error is thrown.
|-----------------------------------------------------------------------------------------------------------------------------------------------|
*/



// HOME RELATED ROUTES
Route::get('/', array('before' => 'auth|firstLogin|authRemember', 'uses' => 'HomeController@getHome'));

Route::get('/open-door', array('before' => 'auth|firstLogin', 'uses' => 'HomeController@logHome'));

Route::get('/open.php', array('before' => 'auth|firstLogin', 'uses' => 'HomeController@getOpenDoor'));

Route::get('/password-change', array('before' => 'auth', 'uses' => 'AuthController@getPasswordChange'));

Route::post('/password-change', array('before' => 'csrf', 'uses' => 'AuthController@postPasswordChange'));
// END OF HOME RELATED ROUTES


// AUTHENTICATION RELATED ROUTES
Route::get('/login', array('before' => 'guest', 'uses' => 'AuthController@getLogin'));

Route::post('/login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));

Route::get('/logout', array('before' => 'auth', 'uses' => 'AuthController@getLogout'));
// END OF AUTHENTICATION ROUTES


// LOGS RELATED ROUTES
Route::get('/open-door-logs', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getOpenDoorLogs'));

Route::get('/user-management-logs', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getUserManagementLogs'));

Route::get('/added-users-logs/{id?}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getAddedUsersLogs'));

Route::get('/modified-users-logs/{id?}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getModifiedUsersLogs'));

Route::get('/reset-users-logs/{id?}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getResetUsersLogs'));

Route::get('/deleted-users-logs/{id?}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getDeletedUsersLogs'));

Route::get('/complete-logs', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getCompleteLogs'));

Route::get('/user-logs/{id}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getUserLogs'));
// END OF LOGS RELATED ROUTES


// USER MANAGEMENT RELATED ROUTES
Route::get('/manage-users', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getManageUsers'));

Route::get('/manage-users/add-user', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getAddUser'));

Route::post('/manage-users/add-user', array('before' => 'csrf', 'uses' => 'UserManagementController@postAddUser'));

Route::get('/manage-users/modify/{id}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getModify'));

Route::post('/manage-users/modify/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postModify'));

Route::get('/manage-users/reset-password/{id}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getResetPassword'));

Route::post('/manage-users/reset-password/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postResetPassword'));

Route::get('/manage-users/delete/{id}', array('before' => 'auth|isAdmin|firstLogin', 'uses' => 'UserManagementController@getDelete'));

Route::post('/manage-users/delete/{id}', array('before' => 'csrf', 'uses' => 'UserManagementController@postDelete'));
// END OF USER MANAGEMENT RELATED ROUTES