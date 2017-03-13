<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model{

	public function teacher(){
		return $this->hasOne('App\User', 'id');
	}

	public function student(){
		return $this->hasMany('App\User', 'id_kelas');
	}

}
