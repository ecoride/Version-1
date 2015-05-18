<?php

use StartMeUp\Models\Reward;
use StartMeUp\User;

class RewardUserTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateRewardUserTable::TABLE)->delete();

		$rewards = Reward::all();
		$users = User::all();

		foreach($rewards as $reward) {
			foreach($users as $user) {
				$reward->users()->attach($user);
				$reward->save();
			}
		}

	}

}
