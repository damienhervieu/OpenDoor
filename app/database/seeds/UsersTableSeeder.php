<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		$users = array(
			array(
				'name' => 'Damien',
				'email' => 'damien.hervieu@ynov.com',
				'password' => Hash::make('damien'),
				'password_changed' => true,
				'permission' => 'admin'
			),
			array(
				'name' => 'damien',
				'email' => 'fallenangel937@hotmail.fr',
				'password' => Hash::make('damien'),
				'password_changed' => true,
				'permission' => 'member'
			)
		);
		DB::table('users')->insert($users);
	}
}