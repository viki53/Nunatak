<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubSportTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('club_sport', function (Blueprint $table) {
			$table->unsignedBigInteger('club_id');
			$table->unsignedBigInteger('sport_id');

			$table->timestamps();

			$table->primary(['club_id', 'sport_id']);

			$table->foreign('club_id')
				->references('id')->on('clubs')
				->onDelete('cascade');

			$table->foreign('sport_id')
				->references('id')->on('sports')
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
		Schema::dropIfExists('club_sport');
		Schema::enableForeignKeyConstraints();
	}
}
