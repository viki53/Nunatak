<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('parent_id')->nullable();
			$table->string('path')->index();
			$table->timestamps();
			$table->softDeletes();

			$table->unique(['site_id', 'path']);

			$table->foreign('site_id')
				->references('id')->on('sites')
				->onDelete('cascade');

			$table->foreign('parent_id')
				->references('id')->on('pages')
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
		Schema::dropIfExists('pages');
		Schema::enableForeignKeyConstraints();
	}
}
