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

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@showWelcome'
	));

Route::get('/about', array(
	'as' => 'about',
	'uses' => 'AboutController@show'
	));

Route::get('/user/{username}', array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@user'
	));

/*
 | Authenticated group
 | 'before' means before the request into your application
 */
 Route::group(array('before' => 'auth'), function()
 {

 	/*
	 | CSRF prevention
	 */
	Route::group(array('before' => 'csrf'), function()
		{
			/*
			 | Change password (POST)
			 */
			Route::post('/account/change-password', array(
				'as' => 'account-change-password-post',
				'uses' => 'AccountController@postChangePassword'
			));
		});

 	/*
 	 | Change Password (GET)
 	 */
 	 Route::get('/account/change-password', array(
			'as' => 'account-change-password',
			'uses' => 'AccountController@getChangePassword'
 	 	));

 	 /*
 	 | Change Password (POST)
 	 */
 	 Route::post('/account/change-password', array(
			'as' => 'account-change-password-post',
			'uses' => 'AccountController@postChangePassword'
 	 	));

 	/*
 	 | Sign out (GET)
 	 */
 	 Route::get('/account/sign-out', array(
			'as' => 'account-sign-out',
			'uses' => 'AccountController@getSignOut'
 	 	));
 });

/*
 | Unauthenticated group
 */
Route::group(array('before' => 'guest'), function()
{
	/*
	 | CSRF prevention
	 */
	Route::group(array('before' => 'csrf'), function()
		{
			/*
			 | Create account (POST)
			 */
			Route::post('/account/create', array(
				'as' => 'account-create-post',
				'uses' => 'AccountController@postCreate'
			));

			/*
			| Forgot password (GET)
			*/
			Route::post('/account/forgot-password', array(
				'as' => 'account-forgot-password-post',
				'uses' => 'AccountController@postForgotPassword'
				));
				});

	/*
	 | Sign in account (GET)
	 */
	Route::get('/account/sign-in', array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
		));

	/*
	 | Sign in account (POST)
	 */
	Route::post('/account/sign-in', array(
		'as' => 'account-sign-in-post',
		'uses' => 'AccountController@postSignIn'
		));

	/*
	 | Create account (GET)
	 */
	Route::get('/account/create', array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
		));

	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
		));

	/*
	| Forgot password (GET)
	*/
	Route::get('/account/forgot-password', array(
		'as' => 'account-forgot-password',
		'uses' => 'AccountController@getForgotPassword'
		));

	/*
	| Recovery (GET)
	*/
	Route::get('/account/recovery/{code}', array(
		'as' => 'account-recovery',
		'uses' => 'AccountController@getRecovery'
		));

});