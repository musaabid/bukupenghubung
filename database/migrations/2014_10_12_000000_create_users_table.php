<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('noinduk')->unique();
			$table->integer('id_kelas')->unsigned()->nullable();
			$table->string('password');
			$table->enum('level', ['admin', 'guru', 'siswa'])->default('guru');
			$table->bigInteger('noktp')->unique()->nullable(); // No KTP guru / ortu
			$table->string('nama'); // Nama guru / siswa
			$table->string('nama_panggilan')->nullable();
			$table->string('tempat_lahir', 255)->nullable(); // Tempat lahir guru / siswa
			$table->date('tanggal_lahir')->nullable(); // Tanggal lahir guru / siswa
			$table->string('agama', 20)->nullable(); // Agama guru / siswa
			$table->enum('jenis_kelamin', ['L','P'])->nullable(); // Jenis kelamin guru / siswa
			$table->string('alamat')->nullable(); // Alamat guru / siswa
			$table->string('telepon_1', 255); // Telepon 1 guru / ortu
			$table->string('telepon_2', 255)->nullable(); // Telepon 2 guru / ortu
			$table->string('status_pegawai', 255)->default('tetap'); // Status pegawai guru
			$table->string('foto')->default('kosong.png'); // Foto guru / siswa
			$table->string('nama_ayah')->nullable();
				$table->string('pekerjaan_ayah')->nullable();
			$table->string('nama_ibu')->nullable();
				$table->string('pekerjaan_ibu')->nullable();
			$table->string('nama_wali')->nullable();
				$table->string('pekerjaan_wali')->nullable();
				$table->string('hubungan_wali')->nullable(); // Hubungan keluarga wali dengan siswa
			$table->rememberToken();
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
		Schema::dropIfExists('users');
	}
}
