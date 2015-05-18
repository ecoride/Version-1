<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration {

	const TABLE = 'regions';

	const PK = 'id';

	const FK = 'region_id';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function(Blueprint $table)
		{
			// Meta Data
			$table->increments(self::PK);

			// Foreign Keys
			$table->unsignedInteger(CreateCountriesTable::FK)
				->nullable();
			$table->foreign(CreateCountriesTable::FK)
				->references(CreateCountriesTable::PK)
				->on(CreateCountriesTable::TABLE)
				->onDelete('set null'); // If `countries` row is deleted then `country_id` must be `null`

			// Data
			$table->char('iso', 3); // ISO 3166-2 Alpha-3
			$table->string('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists(self::TABLE);
	}

}
