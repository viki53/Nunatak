<?php

use Illuminate\Database\Seeder;

class SplashscreensTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$directory = 'public/splashscreens/';
		$files = Storage::files($directory);

		foreach ($files as $file) {
			$filename = str_replace($directory, '', $file);
			App\Splashscreen::firstOrCreate([
				'file_name' => $filename,
				'author_name' => implode(' ', array_map('ucfirst', array_slice(explode('-', $filename), 0, 2)))
			]);
		}
	}
}
