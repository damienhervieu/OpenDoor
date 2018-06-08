<?php

class HomeController extends BaseController {

	public function getHome()
	{
		return View::make('home');
	}

	public function logHome(){
		DB::table('logs')->insert(
			array(
				'changer_id' => Auth::user()->id,
				'action_id' => 4,
				'target_id' => 0,
				'ip' => Request::ip(),
				'user_agent' => Request::header('User-Agent'),
				'created_at' => Carbon::now('Europe/Paris')
			)
		);
	}

	public function getOpenDoor(){
		$output = shell_exec('python /var/www/html/script/opendoor.py');
		echo "<pre>$output</pre>";
	}

}
