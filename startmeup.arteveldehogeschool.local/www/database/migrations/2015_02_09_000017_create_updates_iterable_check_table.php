<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesIterableCheckTable extends Migration {

	const TABLE = 'updates_iterable_check';

	const PK = 'id';

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
			$table->softDeletes(); // 'deleted_at'

			// Foreign Keys
			$table->unsignedInteger(CreateTargetsIterableCheckTable::FK);
			$table->foreign(CreateTargetsIterableCheckTable::FK)
				->references(CreateTargetsIterableCheckTable::PK)
				->on(CreateTargetsIterableCheckTable::TABLE)
				->onDelete('cascade');

			// Data
			$table->timestamp('achieved_at');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(self::TABLE);
	}

}
