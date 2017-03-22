<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schools', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama_sekolah');
			$table->string('kepala_sekolah');
			$table->string('alamat');
			$table->string('telepon');
			$table->string('email');
			$table->string('website');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('schools');
	}
}
