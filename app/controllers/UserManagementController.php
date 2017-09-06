<?php

class UserManagementController extends BaseController {


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

	public function getOpenDoorLogs(){
		$logs = DB::table('logs')->where('action', '=', 'Opened the door')->paginate(15);
		return View::make('logs')->with('logs', $logs);
	}

	public function getCompleteLogs(){
		$logs = DB::table('logs')->paginate(10);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO RETRIEVE THE MANAGE USERS PAGE*/
	public function getManageUsers(){
		$users = User::all();
		return View::make('manage-users')->with('users', $users);
	}



	/* CONTROLLER TO ADD A USER*/
	public function getAddUser(){
		return View::make('userManagement.add-user');
	}

	public function postAddUser(){
		$rules = array('name' => 'required', 'email' => 'required');

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()){
			return Redirect::to('manage-users/add-user')->withErrors($validator);
		} else {
			$random_password = str_random(8);

			$user = new User;
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->password = Hash::make($random_password);
			$user->password_changed = false;
			$user->permission = Input::get('permission');
			$user->save();

			$message = "Created user : ".Input::get('email');
			self::insertLogs($message);

			Mail::send('emails.welcome', array('name' => Input::get('name'), 'random_password' => $random_password), function($message){
        		$message->to(Input::get('email'), Input::get('name'))->subject('Welcome to the Open Door app!');
    		});

    		return Redirect::to('manage-users');
		}
	}
	/* END OF THE CONTROLLER TO ADD A USER*/



	/* CONTROLLER TO MODIFY A USER*/
	public function getModify($id){
		$user = User::find($id);
		return View::make('userManagement.modify')->with('user', $user);
	}

	public function postModify($id){
		$rules = array('name' => 'required', 'email' => 'required');

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()){
			return Redirect::to('manage-users/modify/{id}')->withErrors($validator);
		} else {
			$user = User::find($id);
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->save();

			$message = "Modified the user : ".Input::get('email');
			self::insertLogs($message);

			return Redirect::to('manage-users');
		}
	}
	/* END OF THE CONTROLLER TO MODIFY A USER*/



	/* CONTROLLER TO RESET A USER'S PASSWORD*/
	public function getResetPassword($id){
		$user = User::find($id);
		return View::make('userManagement.reset-password')->with('user', $user);
	}

	public function postResetPassword($id){
		$random_password = str_random(8);

		$user = User::find($id);
		
		Mail::send('emails.reset-password', array('user' => $user, 'random_password' => $random_password), function($message) use ($user){
        	$message->to($user->email, $user->name)->subject('Your password has been reset!');
    	});

		$message = "Reset the password of ".$user->email;
		self::insertLogs($message);

		$user->password = Hash::make($random_password);
		$user->password_changed = false;
		$user->save();

		return Redirect::to('manage-users');
	}
	/* END OF THE CONTROLLER TO RESET A USER'S PASSWORD*/



	/* CONTROLLER TO DELETE A USER*/
	public function getDelete($id){
		$user = User::find($id);
		return View::make('userManagement.delete')->with('user', $user);
	}

	public function postDelete($id){
		$user = User::find($id);
		$user->delete();

		$message = "Deleted the account of ".$user->email;
		self::insertLogs($message);

		return Redirect::to('manage-users');
	}
	/* END OF THE CONTROLLER TO DELETE A USER*/


}