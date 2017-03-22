<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discussions', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_parent')->default(0);
			$table->integer('id_wali_kelas')->unsigned();
				$table->foreign('id_wali_kelas')->references('id')->on('users');
			$table->integer('id_siswa')->unsigned();
				$table->foreign('id_siswa')->references('id')->on('users');
			$table->enum('pengirim', ['guru', 'siswa'])->default('guru');
			$table->string('judul_diskusi')->nullable();
			$table->longText('isi_diskusi');
			$table->enum('dibaca', ['0', '1'])->default('0');
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
		Schema::dropIfExists('discussions');
	}
}
