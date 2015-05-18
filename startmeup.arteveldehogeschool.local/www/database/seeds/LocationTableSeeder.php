<?php

use StartMeUp\Models\Address;
use StartMeUp\Models\Location;
use StartMeUp\User;

class LocationTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateLocationsTable::TABLE)->delete();

		$address = Address::where('street', 'Industrieweg')->where('street_number', '232')->firstOrFail();
		$user = User::first();

		$location = new Location([
			'title'       => 'Arteveldehogeschool',
			'subtitle'    => 'Mediacampus Mariakerke',
			'description' => 'Bachelor in de grafische en digitale media',
			'type'        => Location::TYPE_EDU,
			'latitude'    => 51.086771,
			'longitude'   =>  3.670078,
		]);
		$location->address()->associate($address);
		$location->user()->associate($user);
		$location->save();

		// Faker
		// -----

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {

			$address = Address::find($this->faker->numberBetween(1, $this->fakerMaxItems));

			$location = new Location([
				'title'       => $this->faker->word(),
				'subtitle'    => $this->faker->sentence(3),
				'description' => $this->faker->paragraph(3),
				'type'        => $this->faker->randomElement(Location::TYPES),
				'latitude'    => $this->faker->randomFloat(8, 50.80, 51.20),
				'longitude'   => $this->faker->randomFloat(8,  3.52,  3.92),
			]);
			$location->address()->associate($address);
			$location->save();
		}

	}

}
