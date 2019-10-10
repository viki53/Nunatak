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
        $club = App\Club::create([
			'id' => 1,
			'name' => 'Nunatak Team',
			'registration_number' => '0987654321',
			'country' => 'FR',
		]);

		$club->save();

		$club->users()->attach(1, ['is_owner' => true]);
    }
}
