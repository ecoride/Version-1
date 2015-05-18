<?php

use StartMeUp\Models\Mood;
use StartMeUp\User;

class MoodTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateMoodsTable::TABLE)->delete();

		// Faker
		// -----

		$user = User::first();

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {
			$mood = new Mood([
				'feeling' => $this->faker->randomElement(Mood::FEELINGS),
			]);
			$mood->user()->associate($user);
			$mood->save();

		}

	}

}
