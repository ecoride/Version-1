<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestUserTable extends Migration {

	const TABLE = 'interest_user';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(self::TABLE, function(Blueprint $table)
		{
			// Primary Key
			$table->unsignedInteger(CreateInterestsTable::FK);
			$table->unsignedInteger(CreateUsersTable::FK);
			$table->primary([CreateInterestsTable::FK, CreateUsersTable::FK]); // Composite Key.

			// Foreign Keys
			$table->foreign(CreateInterestsTable::FK)
				->references(CreateInterestsTable::PK)
				->on(CreateInterestsTable::TABLE);
			$table->foreign(CreateUsersTable::FK)
				->references(CreateUsersTable::PK)
				->on(CreateUsersTable::TABLE)
				->onDelete('cascade');
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
