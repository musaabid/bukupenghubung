<?php

use App\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		DB::table('schools')->insert([
			'nama_sekolah' 	=> 'TKK. Tegal Jaya',
			'kepala_sekolah' 	=> 'Magdalena Sri Wahyuni, S.Pd',
			'alamat' 			=> 'Jalan Kubu Gunung no. 888, Tegal Jaya',
			'telepon'			=> '0361413528',
			'email' 				=> 'info@tkktegaljaya.com',
			'website' 			=> 'http://tkktegaljaya.com',
		]);
	}
}
