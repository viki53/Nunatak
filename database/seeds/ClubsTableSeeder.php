<?php

use Illuminate\Database\Seeder;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $club = App\Club::firstOrNew([
			'name' => 'Team Nunatak',
			'registration_number' => '0987654321',
			'country' => 'FR',
		]);

		$club->save();
    }
}
