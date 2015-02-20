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

 
Route::pattern('user_id', '[0-9]+');
 

  
Route::get('/', function(){
	return Redirect::to('home');
})->before('auth') ;
 
 

//home handler
Route::get('home' , array('uses' => 'HomeController@showHome'))->before('auth') ;
 
//Register
// route to show the register form
Route::get('register' , array('uses' => 'HomeController@showRegister'))->before('guest') ;

// route to process the form
Route::post('register' , array('before' => 'csrf' , 'uses' => 'HomeController@doRegister')) ;

//Login
// route to show the login form
Route::get('login' , array('uses' => 'HomeController@showLogin'))->before('guest') ;

// route to process the form
Route::post('login' , array('before' => 'csrf' , 'uses' => 'HomeController@doLogin')) ;

//Logout
// route to the logout process
Route::get('logout' , array('uses' => 'HomeController@doLogout'))->before('auth') ;


 
//change password
Route::get('user/password' , function(){
	return View::make('users.password') ;
})->before('auth') ;

Route::post('user/password' , array('before' => 'csrf' , 'uses' => 'UserController@changePassword' ))->before('auth') ; 

 
//using mail stuff
//email verification
Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'HomeController@confirm'
]);

//resend verification
Route::get('resend_confirm' ,function(){
	return View::make('emails.resend_verfication');
})->before('guest');

Route::post('resend_confirm' ,array('before' => 'csrf' , 'uses' => 'HomeController@resend_confirm'))->before('guest');

Route::get('search/query' , array('uses' => 'HomeController@search'))->before('auth') ;

Route::get('search' ,array('uses' => 'HomeController@showsearch'))->before('auth');

//Password Reset
Route::get('password_reset' ,function(){
	return View::make('emails.password_reset');
})->before('guest');

Route::post('password_reset' , array('before' => 'csrf' ,'uses' => 'HomeController@password_reset'))->before('guest');

//reset form
Route::get('password_reset/{confirmationCode}' , function($confirmationCode){
	return View::make('emails.reset_password')->with('confirmationCode',$confirmationCode);
})->before('guest');

Route::post('password_reset/{confirmationCode}' , array('before' => 'csrf' ,'uses' => 'HomeController@password_reset_withCode'))->before('guest');



