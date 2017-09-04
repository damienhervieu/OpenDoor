<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getHome()
	{
		return View::make('home');
	}

	public function postHome(){
		DB::table('logs')->insert(
			array(
				'name' => Auth::user()->name,
				'email' => Auth::user()->email,
				'action' => 'Opened the door',
				'ip' => Request::ip(),
				'user_agent' => Request::header('User-Agent'),
				'created_at' => Carbon::now('Europe/Paris')
			)
		);

		return Redirect::to('/');
	}

}
