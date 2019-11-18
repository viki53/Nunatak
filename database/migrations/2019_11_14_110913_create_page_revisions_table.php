<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_revisions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('page_id');
			$table->unsignedBigInteger('author_id')->nullable();
			$table->string('title');
			$table->string('subtitle');
			$table->text('content');
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('page_id')
				->references('id')->on('pages')
				->onDelete('cascade');

			$table->foreign('author_id')
				->references('id')->on('users');
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
        Schema::dropIfExists('page_revisions');
		Schema::enableForeignKeyConstraints();
    }
}
