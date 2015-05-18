<?php

use StartMeUp\Models\Address;
use StartMeUp\Models\Locality;

class AddressTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateAddressesTable::TABLE)->delete();

		$locality = Locality::where('postal_code', '9030')->where('name', 'Mariakerke')->firstOrFail();

		$address = new Address;
		$address->street        = 'Industrieweg';
		$address->street_number = '232';
		$address->locality()->associate($locality);
		$address->save();

		// Faker
		// -----
		$localities = Locality::all();

		for ($i = 0; $i < $this->fakerMaxItems; ++$i) {
			$address = new Address;
			$address->street        = $this->faker->streetName;
			$address->street_number = $this->faker->numberBetween(1, 150);
//			$address->locality()->associate($locality);
			$address->locality()->associate($localities->get($this->faker->numberBetween(0, $localities->count() - 1 )));
			$address->save();
		}
	}

}
