<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubUserTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_user', function (Blueprint $table) {
			$table->unsignedBigInteger('club_id');
			$table->unsignedBigInteger('user_id');
			$table->boolean('is_owner')->default(false);
			$table->timestamps();

			$table->primary(['club_id', 'user_id']);

			$table->foreign('club_id')
				->references('id')->on('clubs');

			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
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
		Schema::dropIfExists('club_user');
		Schema::enableForeignKeyConstraints();
	}
}
