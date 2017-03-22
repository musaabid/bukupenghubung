<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
	public function teacher(){
		return $this->hasOne('App\User', 'id', 'id_wali_kelas');
	}

	public function student(){
		return $this->hasOne('App\User', 'id', 'id_siswa');
	}
}
