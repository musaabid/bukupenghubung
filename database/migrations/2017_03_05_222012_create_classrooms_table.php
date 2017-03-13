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

		// Set foreign key di id_kelas dalam table users
		Schema::table( 'users', function (Blueprint $table) { 
			$table->foreign('id_kelas')->references('id')->on('classrooms');
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
