<?php

use StartMeUp\Models\Country;

class CountryTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateCountriesTable::TABLE)->delete();

		$countries = [
			'BE' => 'Belgium',
			'DE' => 'Germany',
			'FR' => 'France',
			'GB' => 'United Kingdom',
			'LU' => 'Luxembourg',
			'NL' => 'Netherlands',
		];

		foreach ($countries as $iso => $name) {
			Country::create([
				'name' => $name,
				'iso'  => $iso,
			]);
		}
	}

}
