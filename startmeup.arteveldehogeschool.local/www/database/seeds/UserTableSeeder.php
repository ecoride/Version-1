<?php

use StartMeUp\User;

class UserTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateUsersTable::TABLE)->delete();

		$user = new User([
			'email'       => 'smu_user@arteveldehs.be',
			'name'        => 'smu_user',
			'password'    => Hash::make('smu_password'),
			'given_name'  => 'StartMeUp',
			'family_name' => 'User',
		]);
		$user->save();

		// Faker
		// -----

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {
			User::create([
				'email'       => $this->faker->unique()->email(),
				'name'        => $this->faker->name(),
				'password'    => Hash::make($this->faker->word()),
				'given_name'  => $this->faker->firstName,
				'family_name' => $this->faker->lastName,
				'birthday'    => $this->faker->date($format = 'Y-m-d', $max = '-18 years'),
				'biography'   => $this->faker->paragraph($sentences = 3),
				'mobile'      => $this->faker->phoneNumber(),
			]);
		}

	}

}
