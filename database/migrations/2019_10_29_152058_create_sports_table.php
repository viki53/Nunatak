<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sports', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->unique();
		});

		Schema::table('clubs', function (Blueprint $table) {
			$table->removeColumn('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::disableForeignKeyConstraints();
		Schema::table('clubs', function (Blueprint $table) {
			$table->string('category')->nullable();
		});
		Schema::dropIfExists('sports');
		Schema::enableForeignKeyConstraints();
	}
}
