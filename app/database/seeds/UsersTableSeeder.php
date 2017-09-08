<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		$users = array(
			array(
				'name' => 'Emmanuel',
				'email' => 'emmanuel@koundou-noviga.com',
				'password' => Hash::make('emmanuel'),
				'password_changed' => true,
				'permission' => 'admin',
				'created_at' => Carbon::now('Europe/Paris')
			)
		);
		DB::table('users')->insert($users);
	}
}