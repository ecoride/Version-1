<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	const TABLE = 'addresses';

	const PK = 'id';

	const FK = 'address_id';

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
			$table->timestamps();  // 'created_at', 'updated_at'
			$table->softDeletes(); // 'deleted_at'

			// Foreign Keys
			$table->unsignedInteger(CreateLocalitiesTable::FK);
			$table->foreign(CreateLocalitiesTable::FK)
				->references(CreateLocalitiesTable::PK)
				->on(CreateLocalitiesTable::TABLE)
				->onDelete('cascade');

			// Data
			$table->string('street');
			$table->string('street_number');
			$table->string('street_extended')
			      ->nullable();
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
