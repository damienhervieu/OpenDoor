<?php

class UsersTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();
		$users = array(
			/*array(
				'name' => 'Emmanuel',
				'email' => 'emmanuel@koundou-noviga.com',
				'password' => Hash::make('emmanuel'),
				'password_changed' => false,
				'permission' => 'admin',
				'created_at' => Carbon::now('Europe/Paris')
			),
			array(
				'name' => 'Sophie',
				'email' => 'sophie@koundou-noviga.com',
				'password' => Hash::make('sophie'),
				'password_changed' => false,
				'permission' => 'admin',
				'created_at' => Carbon::now('Europe/Paris')
			),*/
			array(
				'id' => 1,
				'name' => 'Damien',
				'email' => 'damien@fm-games.com',
				'password' => Hash::make('damien'),
				'password_changed' => true,
				'permission' => 'admin',
				'created_at' => Carbon::now('Europe/Paris')
			),
			array(
				'id' => 2,
				'name' => 'Damien',
				'email' => 'fallenangel937@hotmail.fr',
				'password' => Hash::make('damien'),
				'password_changed' => true,
				'permission' => 'member',
				'created_at' => Carbon::now('Europe/Paris')
			)
		);
		DB::table('users')->insert($users);
	}
}