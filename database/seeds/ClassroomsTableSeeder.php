<?php

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
	}
}
