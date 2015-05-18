<?php

use StartMeUp\Models\Reward;

class RewardTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateRewardsTable::TABLE)->delete();

		// Faker
		// -----

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {
			Reward::create([
				'name'        => ucwords($this->faker->sentence(3)),
				'description' => $this->faker->paragraph(3),
			]);
		}

	}

}
