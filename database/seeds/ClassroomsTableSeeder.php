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
			'id_wali_kelas'	=> 2,
			'nama_kelas'		=> '1A',
			'tahun_ajaran'		=> 2017,
			'tingkat'			=> 'kecil',
			'created_at'	=> date('Y-m-d H:i:s')
		]);
			// Siswa kelas 1A
			DB::table('users')->insert([
				'noinduk'			=> 2753,
				'id_kelas'			=> 1,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Olivia Deviant Andreys',
				'nama_panggilan'	=> 'Olivia',
				'tempat_lahir'		=> 'Mangupura',
				'tanggal_lahir'	=> '2011-05-27',
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


			DB::table('users')->insert([
				'noinduk'			=> 2764,
				'id_kelas'			=> 1,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'I Putu Adhi Kenzie Suta   Narendra',
				'nama_panggilan'	=> 'Kenzie',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2011-08-22',
				'agama'				=> 'Hindu',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Raya Dalung no. 76',
				'telepon_1'			=> '08113867603',
				'nama_ayah'			=> 'I Gede Suwardika',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Ni Made Ayu Dwi Sapta',
				'pekerjaan_ibu'	=> 'Wiraswasta',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2804,
				'id_kelas'			=> 1,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Angeliq Kenya Lituhayu',
				'nama_panggilan'	=> 'Kenya',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2011-01-25',
				'agama'				=> 'Katolik',
				'jenis_kelamin'	=> 'P',
				'alamat'				=> 'Jl. Tukad Unda Blok VII/12 Kediri - Tabanan' ,
				'telepon_1'			=> '087862035757',
				'nama_ayah'			=> 'Eko Meindyarto',
				'pekerjaan_ayah'	=> 'Guru',
				'nama_ibu'			=> 'Emilia Ni Kadek Marwati',
				'pekerjaan_ibu'	=> 'Guru',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2766,
				'id_kelas'			=> 1,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Aradea Bentala Suhilait',
				'nama_panggilan'	=> 'Ben Ben',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2011-07-05',
				'agama'				=> 'Budha',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Sekar Jepun VIII C/31' ,
				'telepon_1'			=> '081246435556',
				'nama_ayah'			=> 'Edy',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Christina',
				'pekerjaan_ibu'	=> '-',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2780,
				'id_kelas'			=> 1,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Benny Leonard Wibowo',
				'nama_panggilan'	=> 'Benny',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2011-07-26',
				'agama'				=> 'Islam',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Penamparan Indah III no. 42' ,
				'telepon_1'			=> '081338211039',
				'nama_ayah'			=> 'Hadi Wibowo',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Juwita Anggaraini',
				'pekerjaan_ibu'	=> '-',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

		DB::table('classrooms')->insert([
			'id_wali_kelas'	=> 1,
			'nama_kelas'		=> '1B',
			'tahun_ajaran'		=> 2017,
			'tingkat'			=> 'besar',
			'created_at'	=> date('Y-m-d H:i:s')
		]);

			DB::table('users')->insert([
				'noinduk'			=> 2733,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Agung Sintiya Riskyana',
				'nama_panggilan'	=> 'Sintiya',
				'tempat_lahir'		=> 'Singaraja',
				'tanggal_lahir'	=> '2010-09-26',
				'agama'				=> 'Islam',
				'jenis_kelamin'	=> 'P',
				'alamat'				=> 'Jl. Kubu Gunung, Br Tegaljaya' ,
				'telepon_1'			=> '081999633107',
				'nama_ayah'			=> 'Apen',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Jakiah',
				'pekerjaan_ibu'	=> '-',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2761,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Agung Timothy Dwianda Nugraha',
				'nama_panggilan'	=> 'Timothy',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2010-09-17',
				'agama'				=> 'Kristen',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Kubu Gunung Indah no.9 - Tegaljaya' ,
				'telepon_1'			=> '08123909701',
				'nama_ayah'			=> 'Tri Utomo Wiryantono',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Luh Putu Astriani',
				'pekerjaan_ibu'	=> 'Swasta',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2721,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Made Agus Deri Indrayana',
				'nama_panggilan'	=> 'Deri',
				'tempat_lahir'		=> 'Singaraja',
				'tanggal_lahir'	=> '2010-10-24',
				'agama'				=> 'Hindu',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Gunung Guntur, Perum Tanah Guntur Permai 18B - Padang Sambian' ,
				'telepon_1'			=> '085738372504',
				'nama_ayah'			=> 'I Wayan Heri Diatmika',
				'pekerjaan_ayah'	=> 'Wiraswasta',
				'nama_ibu'			=> 'Ni Luh Wayan Sukarini ',
				'pekerjaan_ibu'	=> '-',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2751,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'Alexandrya Leony Latumahina',
				'nama_panggilan'	=> 'Sandra',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2010-08-12',
				'agama'				=> 'Katolik',
				'jenis_kelamin'	=> 'P',
				'alamat'				=> 'Jl. Nangka Gang Turi no. 1 Denpasar' ,
				'telepon_1'			=> '081361264009',
				'nama_ayah'			=> 'Paultje Hendrik Latumahina',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Monica Regelinde Aloysia Nago M.',
				'pekerjaan_ibu'	=> 'Swasta',
				'created_at'		=> date('Y-m-d H:i:s')
			]);

			DB::table('users')->insert([
				'noinduk'			=> 2747,
				'id_kelas'			=> 2,
				'password'			=> bcrypt('password'),
				'level'				=> 'siswa',
				'nama'				=> 'I Gusti Gde Ngurah Arya Sedana',
				'nama_panggilan'	=> 'Turah Arya',
				'tempat_lahir'		=> 'Denpasar',
				'tanggal_lahir'	=> '2010-09-07',
				'agama'				=> 'Hindu',
				'jenis_kelamin'	=> 'L',
				'alamat'				=> 'Jl. Muding Indah Gang MElati no. 3' ,
				'telepon_1'			=> '087862856498',
				'nama_ayah'			=> 'I Gusti Gde Putra Darmawan',
				'pekerjaan_ayah'	=> 'Swasta',
				'nama_ibu'			=> 'Ni Nyoman Tri Yuli Utami.',
				'pekerjaan_ibu'	=> '',
				'created_at'		=> date('Y-m-d H:i:s')
			]);
	}
}
