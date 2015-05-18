<?php

use StartMeUp\Models\Category;
use StartMeUp\User;

class CategoryTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateCategoriesTable::TABLE)->delete();

		$categories = [
			[
				'name'        => 'Startup Formalities',
				'description' => 'Goals related to the formal requirements for starting a business.',
			],
			[
				'name'        => 'Business Plan',
				'description' => 'Goals that are part of your business plan.',
			],
			[
				'name'        => 'Healthy Living',
				'description' => 'Goals to keep you mentally and physically fit.',
			],
			[
				'name'        => 'Social Life',
				'description' => 'Goals to keep your social life alive and kicking.',
			],
			[
				'name'        => 'Zen Calming Activities',
				'description' => 'Activities at regular intervals to calm yourself.',
			],

		];

		$order = 0;
		foreach ($categories as $data) {
			$category = Category::create($data);
			$category->order = $order++;
			$category->save();
		}

		$order = 0;
		$user = User::first();
		foreach ($categories as $data) {
			$category = Category::create($data);
			$category->order = $order++;
			$category->user()->associate($user);
			$category->save();
		}

	}

}
