<?php
use Illuminate\Support\Str;

class Helper {
	
	public static function tahun_ajaran( $year ){
		$dateString = $year. '-01-01 09:09:09';
		$t = strtotime($dateString);
		$t2 = strtotime('+1 year', $t);
		return $year . ' / ' . date( 'Y', $t2 );
	}

}