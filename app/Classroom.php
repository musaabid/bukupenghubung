<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model{

	public function teacher(){
		return $this->hasOne('App\User', 'id', 'id_wali_kelas');
	}

	public function students(){
		return $this->hasMany('App\User', 'id_kelas');
	}

}
