<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalitiesTable extends Migration {

	const TABLE = 'localities';

	const PK = 'id';

	const FK = 'locality_id';

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
			$table->increments('id');

			// Foreign Keys
			$table->unsignedInteger(CreateRegionsTable::FK)
				->nullable();
			$table->foreign(CreateRegionsTable::FK)
				->references(CreateRegionsTable::PK)
				->on(CreateRegionsTable::TABLE)
				->onDelete('set null');

			// Data
			$table->string('postal_code');
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
