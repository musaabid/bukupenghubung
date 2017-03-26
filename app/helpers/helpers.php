<?php

use App\School;
use App\Discussion;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Helper {
	
	public static function nama_sekolah(){
		$school = School::find(1);
		return $school->nama_sekolah;
	}

	public static function tahun_ajaran( $year ){
		$dateString = $year. '-01-01 09:09:09';
		$t = strtotime($dateString);
		$t2 = strtotime('+1 year', $t);
		return $year . ' / ' . date( 'Y', $t2 );
	}

	public static function format_tanggal($tanggal, $format){
		$tanggal = Carbon::parse($tanggal);
		return $tanggal->format($format);
	}

	public static function usia($tanggal_lahir){
		return Carbon::parse($tanggal_lahir)->age;
	}

	public static function humantime($tanggal){
		Carbon::setLocale('id');
		$tanggal = Carbon::parse($tanggal);
		return $tanggal->diffForHumans();
	}

	public static function belumdibaca($id_penerima, $pengirim){
		if($pengirim == 'guru'){
			$unread = Discussion::where([
				['id_siswa', '=', $id_penerima],
				['pengirim', '=', $pengirim],
				['dibaca', '=', '0']
			])->get();
		} elseif($pengirim == 'siswa') {
			$unread = Discussion::where([
				['id_wali_kelas', '=', $id_penerima],
				['pengirim', '=', $pengirim],
				['dibaca', '=', '0']
			])->get();
		}
		return count($unread);
	}

	public static function diskusiunread($id_parent, $pengirim){
		$unread = Discussion::where([
			['id_parent', '=', $id_parent],
			['pengirim', '=', $pengirim],
			['dibaca', '=', '0']
		])->get();

		return count($unread);
	}

}