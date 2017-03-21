<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run(){
		DB::table('users')->insert([
			'noinduk'			=> 19930823001,
			'password'			=> bcrypt('password'),
			'level'				=> 'admin',
			'noktp'				=> 5171022308930006,
			'nama'				=> 'Yongki Agustinus',
			'tempat_lahir'		=> 'Surabaya',
			'tanggal_lahir'	=> '1993-08-23',
			'agama'				=> 'Kristen',
			'jenis_kelamin' 	=> 'L',
			'alamat'				=> 'Muding Indah IX, Tara residence no. 4',
			'telepon_1'			=> '087862035757',
			'foto'				=> '1489152677_19930823001.png',
			'created_at'		=> date('Y-m-d H:i:s')
		]);
		DB::table('users')->insert([
			'noinduk'			=> 19940209001,
			'password'			=> bcrypt('password'),
			'level'				=> 'guru',
			'noktp'				=> 5171021902940002,
			'nama'				=> 'Febri Dwi Cahyani',
			'tempat_lahir'		=> 'Denpasar',
			'tanggal_lahir'	=> '1994-02-09',
			'agama'				=> 'Kristen',
			'jenis_kelamin' 	=> 'P',
			'alamat'				=> 'Muding Indah IX, Tara residence no. 4',
			'telepon_1'			=> '087861800023',
			'foto'				=> '1489115191_19940209001.png',
			'created_at'		=> date('Y-m-d H:i:s')
		]);
		DB::table('users')->insert([
			'noinduk'			=> 12345678910,
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
			'pekerjaan_ibu'		=> 'PNS',
			'created_at'		=> date('Y-m-d H:i:s')
		]);
	}
}
