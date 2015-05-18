<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use StartMeUp\Models\Settings;

class CreateSettingsTable extends Migration {

	const TABLE = 'settings';

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

			// Foreign Keys
			$table->unsignedInteger(CreateUsersTable::FK);
			$table->foreign(CreateUsersTable::FK)
				->references(CreateUsersTable::PK)
				->on(CreateUsersTable::TABLE)
				->onDelete('cascade'); // If `users` row is deleted then `settings` rows also.
			$table->unsignedInteger('language_id');
			$table->unsignedInteger('timezone_id');

			// Data
			$table->enum('colour', Settings::COLOUR_PALETTES)
				->default(Settings::COLOUR_PALETTE_A);
			$table->boolean('want_to_collaborate') ->default(false);
			$table->boolean('notifications')       ->default(true);
			$table->boolean('share_address_street')->default(false);
			$table->boolean('share_interests')     ->default(false);
			$table->boolean('share_locality')      ->default(false); // City
			$table->boolean('share_location')      ->default(false); // Current location
			$table->boolean('share_progress')      ->default(false); // ? goal progress
			$table->boolean('share_user_birthday') ->default(false);
			$table->boolean('share_user_email')    ->default(false);
			$table->boolean('share_user_gender')   ->default(false);
			$table->boolean('share_user_mobile')   ->default(false);
			$table->boolean('share_user_picture')  ->default(false);
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
