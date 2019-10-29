<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */
		public function run()
		{
		$user = App\User::firstOrNew([
						'name' => 'Corentin Hatte',
			'email' => 'viki53000+nunatak@gmail.com',
			'phone' => '+33665424497',
		]);

		$user->password = bcrypt('password');

		$user->save();

		$user->clubs()->syncWithoutDetaching([1, ['is_owner' => true]]);
		}
}
