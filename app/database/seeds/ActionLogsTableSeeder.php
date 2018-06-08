<?php

class ActionLogsTableSeeder extends Seeder {

	public function run() {
		DB::table('action_logs')->delete();
		$action_logs = array(
			array(
				'action' => 'Logged in via email and password'
			),
			array(
				'action' => 'Logged in via Remember Me'
			),
			array(
				'action' => 'Changed his password'
			),
			array(
				'action' => 'Opened the door'
			),
			array(
				'action' => 'Logged out'
			),
			array(
				'action' => 'Created an account'
			),
			array(
				'action' => "Modified the account's name"
			),
			array(
				'action' => "Modified the account's email"
			),
			array(
				'action' => "Modified the account's name and email"
			),
			array(
				'action' => 'Reset a password'
			),
			array(
				'action' => 'Deleted an account'
			)
		);
		DB::table('action_logs')->insert($action_logs);
	}
}