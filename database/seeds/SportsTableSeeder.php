<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$file = File::get(resource_path().'/data/club_categories.txt');

		$names = array_map('trim', explode("\n", $file));

		foreach($names as $name) {
			if (empty($name)) {
				continue;
			}

			$sport = App\Sport::firstOrCreate([
				'name' => $name,
			]);
		}
    }
}
