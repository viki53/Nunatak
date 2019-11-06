<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubPendingMembersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('club_pending_members', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('club_id');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->string('user_email');
			$table->string('user_name');
			$table->timestamps();
			$table->softDeletes();

			$table->index('user_email');

			$table->foreign('club_id')
				->references('id')->on('clubs')
				->onDelete('cascade');

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
		Schema::dropIfExists('club_pending_members');
		Schema::enableForeignKeyConstraints();
	}
}
