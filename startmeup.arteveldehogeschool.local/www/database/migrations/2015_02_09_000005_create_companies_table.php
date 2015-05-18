<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	const TABLE = 'companies';

	const PK = 'id';

	const FK = 'company_id';

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
			$table->timestamps();  // 'created_at', 'updated_at'

			// Foreign Keys
			$table->unsignedInteger(CreateAddressesTable::FK)
				->nullable();
			$table->foreign(CreateAddressesTable::FK)
				->references(CreateAddressesTable::PK)
				->on(CreateAddressesTable::TABLE)
				->onDelete('cascade');

			// Data
			$table->string('name');
			$table->text('description');
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
