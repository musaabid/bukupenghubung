<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model{

	public function author(){
		return $this->hasOne('App\User', 'id', 'id_author');
	}

	public function classroom(){
		return $this->hasOne('App\Classroom', 'id', 'id_kelas');
	}

}
