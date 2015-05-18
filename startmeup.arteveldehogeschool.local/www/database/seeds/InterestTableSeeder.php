<?php

use StartMeUp\Models\Interest;

class InterestTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateInterestsTable::TABLE)->delete();

		// Faker
		// -----

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {
			Interest::create([
				'name' => $this->faker->unique()->word(),
			]);
		}

	}

}
