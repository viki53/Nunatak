<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clubs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->index();
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->string('country')->index();
			$table->string('registration_number')->unique();
			$table->string('category')->nullable();
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
		Schema::dropIfExists('clubs');
	}
}
