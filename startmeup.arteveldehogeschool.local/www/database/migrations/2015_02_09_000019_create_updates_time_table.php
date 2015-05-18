<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdatesTimeTable extends Migration {

	const TABLE = 'updates_time';

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
			$table->unsignedInteger(CreateTargetsTimeTable::FK);
			$table->foreign(CreateTargetsTimeTable::FK)
				->references(CreateTargetsTimeTable::PK)
				->on(CreateTargetsTimeTable::TABLE)
				->onDelete('cascade');

			// Data
			$table->smallInteger('time_incrementation')
				->unsigned(); // Times 'targets_time.time_increment'
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
