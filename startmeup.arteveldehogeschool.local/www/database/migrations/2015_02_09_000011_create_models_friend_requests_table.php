<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use StartMeUp\Models\FriendRequest;

class CreateModelsFriendRequestsTable extends Migration {

	const TABLE = 'friend_requests';

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
			$table->unsignedInteger(CreateUsersTable::FK);
			$table->unsignedInteger(CreateUsersTable::FK_FRIEND);
			$table->primary([CreateUsersTable::FK, CreateUsersTable::FK_FRIEND]); // Composite Key.
			$table->timestamps();

			// Foreign Keys
			$table->foreign(CreateUsersTable::FK)
				->references(CreateUsersTable::PK)
				->on(CreateUsersTable::TABLE);
			$table->foreign(CreateUsersTable::FK_FRIEND)
				->references(CreateUsersTable::PK)
				->on(CreateUsersTable::TABLE);

			// Data
			$table->enum('status', FriendRequest::STATUSES)
				->default(FriendRequest::STATUS_PENDING);

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
