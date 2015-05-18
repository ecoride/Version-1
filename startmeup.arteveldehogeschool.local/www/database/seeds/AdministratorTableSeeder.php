<?php

use StartMeUp\Models\Administrator;

class AdministratorTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateAdministratorsTable::TABLE)->delete();

		$user = new Administrator([
			'email'    => 'smu_admin@arteveldehs.be',
			'name'     => 'smu_admin',
			'password' => Hash::make('smu_password'),
		]);
		$user->save();
	}

}
