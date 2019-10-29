<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSplashscreensTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('splashscreens', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('file_name');
			$table->string('author_name')->nullable();
			$table->string('author_url')->nullable();
			$table->string('caption')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('splashscreens');
	}
}
