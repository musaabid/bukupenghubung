<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('announcements', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_author')->unsigned();
				$table->foreign('id_author')->references('id')->on('users');
			$table->integer('id_kelas')->unsigned()->nullable();
				$table->foreign('id_kelas')->references('id')->on('classrooms');
			$table->longText('pengumuman');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('announcements');
	}
}
