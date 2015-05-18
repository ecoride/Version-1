<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use StartMeUp\Models\TargetIterableCheck;

class CreateTargetsIterableCheckTable extends Migration {

	const TABLE = 'targets_iterable_check';

	const PK = 'id';

	const FK = 'target_id';

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

			// Data
			$table->dateTime('deadline_at');
			$table->enum('repeat_deadline', TargetIterableCheck::REPEATS)
				->nullable();
			$table->dateTime('repeat_until_at')
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
		Schema::drop(self::TABLE);
	}

}
