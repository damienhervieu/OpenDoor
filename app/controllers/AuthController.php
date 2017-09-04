<?php

class AuthController extends BaseController {

	public function insertLogs($message){
		DB::table('logs')->insert(
			array(
				'name' => Auth::user()->name,
				'email' => Auth::user()->email,
				'action' => $message,
				'ip' => Request::ip(),
				'user_agent' => Request::header('User-Agent'),
				'created_at' => Carbon::now('Europe/Paris')
			)
		);
	}


	public function getPasswordChange(){
		return View::make('password-change');
	}

	public function postPasswordChange(){
		$rules = array('password' => 'required', 'password2' => 'required|same:password');

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()){
			return Redirect::to('password-change')->withErrors($validator);
		} else {
			$user = User::find(Auth::id());

			$user->password = Hash::make(Input::get('password'));
			$user->password_changed = true;
			$user->save();

			$message = "Changed password";
			self::insertLogs($message);

			return Redirect::to('/');
		}
	}

	public function getLogin(){
		return View::make('login');
	}

	public function postLogin(){
		$remember = (Input::has('remember')) ? true : false;

		$rules = array('email' => 'required', 'password' => 'required');
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()){
			return Redirect::to('login')->withErrors($validator);
		}
		$auth = Auth::attempt(array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		), $remember);
		if (!$auth) {
			return Redirect::to('login')->withErrors(array(
				'Invalid credentials were provided.'
			));
		}
		
		$message = "Logged in via email and password";
		self::insertLogs($message);

		return Redirect::to('/');
	}



	public function getLogout(){
		$message = "Logged out";
		self::insertLogs($message);
		Auth::logout();
		return Redirect::to('/login');
	}

}