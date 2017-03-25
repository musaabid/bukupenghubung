<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'noinduk', 'email', 'password', 'level', 'nama', 'telepon_1'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token'
	];

	public function classroom() {
		return $this->hasOne('App\Classroom', 'id_wali_kelas');
	}

	public function kelas(){
		return $this->hasOne('App\Classroom', 'id', 'id_kelas');
	}

}
