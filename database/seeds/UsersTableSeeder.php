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
		App\User::create([
			'id' => 1,
            'name' => 'Corentin Hatte',
			'email' => 'viki53000+nunatak@gmail.com',
			'phone' => '+33665424497',
            'password' => bcrypt('password'),
        ])->save();
    }
}
