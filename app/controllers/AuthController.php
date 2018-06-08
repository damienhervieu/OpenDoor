<?php

class AuthController extends BaseController {

	public function insertLogs($action, $target){
		DB::table('logs')->insert(
			array(
				'changer_id' => Auth::user()->id,
				'action_id' => $action,
				'target_id' => $target,
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

			$action = 3/*"Changed password"*/;
			$target = 0;
			self::insertLogs($action, $target);

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
		
		$action = 1/*"Logged in via email and password"*/;
		$target = 0;
		self::insertLogs($action, $target);

		return Redirect::to('/');
	}



	public function getLogout(){
		$action = 5/*"Logged out"*/;
		$target = 0;
		self::insertLogs($action, $target);
		Auth::logout();
		return Redirect::to('/login');
	}

}