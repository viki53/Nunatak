<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('title')->index();
			$table->string('domain')->unique();
			$table->unsignedBigInteger('club_id');
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('club_id')
				->references('id')->on('clubs')
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
		Schema::dropIfExists('sites');
		Schema::enableForeignKeyConstraints();
	}
}
