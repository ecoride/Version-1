<?php

use Carbon\Carbon;
use StartMeUp\Models\Category;
use StartMeUp\Models\Goal;
use StartMeUp\Models\TargetCheck;
use StartMeUp\Models\TargetIterableCheck;
use StartMeUp\Models\TargetTime;
use StartMeUp\User;

class GoalTableSeeder extends StartMeUpSeeder {

	public function run()
	{
		DB::table(CreateGoalsTable::TABLE)->delete();
		DB::table(CreateTargetsCheckTable::TABLE)->delete();
		DB::table(CreateTargetsIterableCheckTable::TABLE)->delete();
		DB::table(CreateTargetsTimeTable::TABLE)->delete();

		$user = User::first();
		$categories = Category::where('user_id', $user->id)->get();

		$category = $categories->where('name', 'Startup Formalities')->first();

		$goalsData = [
			[
				'name'  => 'Company registration number',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Health insurance',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Social security',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'VAT registration',
				'notes' => $this->faker->paragraph(3),
			],
		];

		$order = 0;
		foreach ($goalsData as $data) {
			$target = new TargetCheck([
				'deadline_at' => Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)),
			]);
			$target->save();

			$goal = new Goal($data);
			$goal->order = $order++;
			$goal->user()->associate($user);
			$goal->category()->associate($category);
			$goal->target()->associate($target);
			$goal->save();
		}

		$category = $categories->where('name', 'Business Plan')->first();

		$goalsData = [
			[
				'name'  => 'Clients',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Commercial Plan',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Financial Plan',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Market Research',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Suppliers',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
		];

		$order = 0;
		foreach ($goalsData as $data) {
			$repeatDeadline = $this->faker->randomElement(TargetIterableCheck::REPEATS);
			$repeatUntilAt = ($repeatDeadline) ? Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)) : null;

			$target = new TargetIterableCheck([
				'deadline_at' => Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)),
				'repeat_deadline' => $repeatDeadline,
				'repeat_until_at' => $repeatUntilAt,
			]);
			$target->save();

			$goal = new Goal($data);
			$goal->order = $order++;
			$goal->user()->associate($user);
			$goal->category()->associate($category);
			$goal->target()->associate($target);
			$goal->save();
		}

		$category = $categories->where('name', 'Healthy Living')->first();

		$goalsData = [
			[
				'name'  => 'Healthy food',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Physical activity',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Sleep',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
		];

		$order = 0;
		foreach ($goalsData as $data) {
			$repeatDeadline = $this->faker->randomElement(TargetIterableCheck::REPEATS);
			$repeatUntilAt = ($repeatDeadline) ? Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)) : null;

			$target = new TargetIterableCheck([
				'deadline_at' => Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)),
				'repeat_deadline' => $repeatDeadline,
				'repeat_until_at' => $repeatUntilAt,
			]);

			$target->save();

			$goal = new Goal($data);
			$goal->order = $order++;
			$goal->user()->associate($user);
			$goal->category()->associate($category);
			$goal->target()->associate($target);
			$goal->save();
		}

		$category = $categories->where('name', 'Social Life')->first();

		$goalsData = [
			[
				'name'  => 'Family gathering',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Friends gathering',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Peer gathering',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
		];

		$order = 0;
		foreach ($goalsData as $data) {
			$deadline = Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10));
			$repeatDeadline = $this->faker->randomElement(TargetIterableCheck::REPEATS);
			$repeatUntilAt = ($repeatDeadline) ? $deadline->addWeek($this->faker->numberBetween($min = 1, $max = 10)) : null;

			$target = new TargetIterableCheck([
				'deadline_at' => Carbon::now()->addWeek($this->faker->numberBetween($min = 1, $max = 10)),
				'repeat_deadline' => $repeatDeadline,
				'repeat_until_at' => $repeatUntilAt,
			]);
			$target->save();

			$goal = new Goal($data);
			$goal->order = $order++;
			$goal->user()->associate($user);
			$goal->category()->associate($category);
			$goal->target()->associate($target);
			$goal->save();
		}

		$category = $categories->where('name', 'Zen Calming Activities')->first();

		$goalsData = [
			[
				'name'  => 'Meditation',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Tai Chi',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Yoga',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
			[
				'name'  => 'Walking',
				'notes' => $this->faker->paragraph($senctences = 3),
			],
		];

		$order = 0;
		foreach ($goalsData as $data) {
			$target = new TargetTime([
				'time_estimated' => $this->faker->numberBetween($min = 1, $max = 96),
				'time_increment' => 15,
			]);
			$target->save();

			$goal = new Goal($data);
			$goal->order = $order++;
			$goal->user()->associate($user);
			$goal->category()->associate($category);
			$goal->target()->associate($target);
			$goal->save();
		}

	}

}
