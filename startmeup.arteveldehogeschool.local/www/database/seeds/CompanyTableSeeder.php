<?php

use StartMeUp\Models\Address;
use StartMeUp\Models\Company;

class CompanyTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateCompaniesTable::TABLE)->delete();

		$address = Address::where('street', 'Industrieweg')->where('street_number', '232')->firstOrFail();

		$company = new Company;
		$company->name        = 'Arteveldehogeschool';
		$company->description = 'Mediacampus Mariakerke';
		$company->address()->associate($address);
		$company->save();

		// Faker
		// -----

		for ($i = 1; $i <= $this->fakerMaxItems; ++$i) {

			$address = Address::find($this->faker->unique()->numberBetween(1, $this->fakerMaxItems));

			$company = new Company;
			$company->name        = $this->faker->unique()->company();
			$company->description = $this->faker->paragraph(3);
			$company->address()->associate($address);
			$company->save();

		}
	}

}
