<?php

use App\User;
use App\Classroom;
use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		DB::table('classrooms')->insert([
			'id_wali_kelas'	=> 1,
			'nama_kelas'		=> '1A',
			'tahun_ajaran'		=> 2017,
			'tingkat'			=> 'kecil',
			'created_at'	=> date('Y-m-d H:i:s')
		]);

		DB::table('classrooms')->insert([
			'id_wali_kelas'	=> 2,
			'nama_kelas'		=> '1B',
			'tahun_ajaran'		=> 2017,
			'tingkat'			=> 'besar',
			'created_at'	=> date('Y-m-d H:i:s')
		]);
			// Siswa kelas 1B
			DB::table('users')->insert([
				'noinduk'			=> 12345678910,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Olivia Deviant Andreys',
				'nama_panggilan'	=> 'Olivia',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2011-04-24',
				'agama'				=> 'Kristen',
				'jenis_kelamin'	=> 'P',
				'alamat'				=> 'Dalung Permai blok LL no. 41',
				'telepon_1'			=> '087861800023',
				'nama_ayah'			=> 'Robert Nicco Andreys',
				'pekerjaan_ayah'	=> 'Pendeta',
				'nama_ibu'			=> 'Fransiska Novianti',
				'pekerjaan_ibu'	=> 'PNS',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

	}
}
