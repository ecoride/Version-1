<?php

use StartMeUp\Models\Settings;
use StartMeUp\User;

class SettingsTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateSettingsTable::TABLE)->delete();

		$user = User::find(1);

		$settings = new Settings;
		$settings->user()->associate($user);
		$settings->save();
	}

}
