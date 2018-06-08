<?php

class UserManagementController extends BaseController {

	//Prepared SQL query for insertions into the "logs" table
	public function insertManagementLogs($action, $target, $oldValue, $newValue){
		DB::table('logs')->insert(
			array(
				'changer_id' => Auth::user()->id,
				'action_id' => $action,
				'target_id' => $target,
				'old_value' => $oldValue,
				'new_value' => $newValue,
				'ip' => Request::ip(),
				'user_agent' => Request::header('User-Agent'),
				'created_at' => Carbon::now('Europe/Paris')
			)
		);
	}

	/* CONTROLLER TO GET OPEN DOOR LOGS PAGE*/
	public function getOpenDoorLogs(){
		$logs = Logs::where('action_id', '=', 4)->orderBy('created_at', 'desc')->paginate(20);
		$userUrl = null;
		return View::make('logs')->with('logs', $logs)->with('userUrl', $userUrl);
	}

	/* CONTROLLER TO GET THE USER MANAGEMENT LOGS PAGE*/
	public function getUserManagementLogs(){
		$logs = Logs::where('action_id', '>', 5)->orderBy('created_at', 'desc')->paginate(20);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE ADDED USERS LOGS PAGE*/
	public function getAddedUsersLogs(){
		$logs = Logs::where('action_id', '=', 6)->orderBy('created_at', 'desc')->paginate(20);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE MODIFIED USERS LOGS PAGE*/
	public function getModifiedUsersLogs(){
		$logs = Logs::whereBetween('action_id', [6, 8])->orderBy('created_at', 'desc')->paginate(20);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE RESET USERS LOGS PAGE*/
	public function getResetUsersLogs(){
		$logs = Logs::where('action_id', '=', 10)->orderBy('created_at', 'desc')->paginate(20);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE DELETED USERS LOGS PAGE*/
	public function getDeletedUsersLogs(){
		$logs = Logs::where('action_id', '=', 11)->orderBy('created_at', 'desc')->paginate(20);
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE COMPLETE LOGS PAGE*/
	public function getCompleteLogs(){
		$logs = Logs::with('action', 'changer', 'target')->orderBy('created_at', 'desc')->paginate(20);
		/*$logs = DB::table('logs')->paginate(10);*/
		return View::make('logs')->with('logs', $logs);
	}

	/* CONTROLLER TO GET THE MANAGE USERS PAGE*/
	public function getManageUsers(){
		$users = User::all();
		return View::make('manage-users')->with('users', $users);
	}

	/* CONTROLLER TO GET THE USERS LOGS PAGE*/
	public function getUserLogs($id){
		$logs = Logs::where('changer_id', '=', $id)->orderBy('created_at', 'desc')->paginate(20);
		$userUrl = 'user-logs/'.$id;
		return View::make('logs')->with('logs', $logs)->with('userUrl', $userUrl);
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
			//Creating a random generated password for the first connection
			$random_password = str_random(8);

			//Updating "users" table with new user's attributes
			$user = new User;
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->password = Hash::make($random_password);
			$user->password_changed = false;
			$user->permission = Input::get('permission');
			$user->save();

			//Defining the data to complete the insertion in the "logs" table
			$action = 6; //"Created an account"
			$target = $user->id;
			$oldValue = null;
			$newValue = Input::get('email');

			//Inserting into the "logs" table
			self::insertManagementLogs($action, $target, $oldValue, $newValue);

			//Sending the automated email with the user's credentials
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
			if ($user->name != Input::get('name') && $user->email != Input::get('email')) {
				//Keeping the old value for the logs
				$oldValue = $user->name + ', ' + $user->email;
				
				//Updating "users" table with changes
				$user->name = Input::get('name');
				$user->email = Input::get('email');
				$user->save();

				//Defining the remaining data to complete the insertion in the "logs" table
				$action = 9 /*"Modified the account's name and email"*/;
				$target = $id;
				$newValue = Input::get('name') + ', ' + Input::get('email');

				//Inserting into the "logs" table
				self::insertManagementLogs($action, $target, $oldValue, $newValue);
			} elseif ($user->name != Input::get('name') && $user->email == Input::get('email')) {
				//Keeping the old value for the logs
				$oldValue = $user->name;

				//Updating "users" table with changes
				$user->name = Input::get('name');
				$user->save();

				//Defining the remaining data to complete the insertion in the logs table
				$action = 7; //"Modified the account's name"
				$target = $id;
				$newValue = Input::get('name');

				//Inserting into the "logs" table
				self::insertManagementLogs($action, $target, $oldValue, $newValue);
			} elseif ($user->name == Input::get('name') && $user->email != Input::get('email')) {
				//Keeping the old value for the logs
				$oldValue = $user->name;

				//Updating "users" table with changes
				$user->email = Input::get('email');
				$user->save();

				//Defining the remaining data to complete the insertion in the logs table
				$action = 8; //"Modified the account's email"
				$target = $id;
				$newValue = Input::get('email');

				//Inserting into the "logs" table
				self::insertManagementLogs($action, $target, $oldValue, $newValue);
			}

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
		if ((Input::get('reset')) == 'yes') {
			//Creating the new passord
			$random_password = str_random(8);

			$user = User::find($id);

			//Updating the "users" table with changes
			$user->password = Hash::make($random_password);
			$user->password_changed = false;
			$user->save();

			//Defining the data to insert the new log into the "logs" table
			$action = 8 /*"Reset the password of ".$user->email*/;
			$target = $id;
			$oldValue = null;
			$newValue = null;

			//Inserting into the "logs" table
			self::insertManagementLogs($action, $target, $oldValue, $newValue);
			
			//Sending an automated mail to the user to reset his password
			Mail::send('emails.reset-password', array('user' => $user, 'random_password' => $random_password), function($message) use ($user){
	        	$message->to($user->email, $user->name)->subject('Your password has been reset!');
	    	});

			return Redirect::to('manage-users');
		} elseif ((Input::get('reset')) == 'no') {
			return Redirect::to('manage-users');
		}
		
	}
	/* END OF THE CONTROLLER TO RESET A USER'S PASSWORD*/



	/* CONTROLLER TO DELETE A USER*/
	public function getDelete($id){
		$user = User::find($id);
		return View::make('userManagement.delete')->with('user', $user);
	}

	public function postDelete($id){
		//If the manager confirms the deletion
		if((Input::get('delete')) == 'yes'){

			//Deletion of the user in the "users" table
			$user = User::find($id);
			//Keeping the user's email for tracability and also to insert the value into the logs
			$oldValue = $user->email;
			$user->delete();

			//Defining the remaining data to insert the new log into the "logs" table
			$action = 9 /*"Deleted the account of ".$user->email*/;
			$target = $id;
			$newValue = null;

			//Inserting into the "logs" table
			self::insertManagementLogs($action, $target, $oldValue, $newValue);

			return Redirect::to('manage-users');
		} elseif ((Input::get('delete')) == 'no') {
			return Redirect::to('manage-users');
		}
	}
	/* END OF THE CONTROLLER TO DELETE A USER*/


}