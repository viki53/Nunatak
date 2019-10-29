<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(SplashscreensTableSeeder::class);
		$this->call(SportsTableSeeder::class);
		$this->call(ClubsTableSeeder::class);
		$this->call(UsersTableSeeder::class);
	}
}
