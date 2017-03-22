<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classrooms', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_wali_kelas')->unsigned();
				$table->foreign('id_wali_kelas')->references('id')->on('users');
			$table->string('nama_kelas');
			$table->integer('tahun_ajaran');
			$table->enum('tingkat', ['kecil','besar']);
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
		Schema::dropIfExists('classrooms');
	}
}
