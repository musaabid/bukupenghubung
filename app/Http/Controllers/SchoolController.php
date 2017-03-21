<?php

namespace App\Http\Controllers;

use \Auth;
use App\User;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SchoolController extends Controller{

	// Cek otentikasi login
	public function __construct(){
		$this->middleware('auth');
	}

	// Halaman edit profil
	public function index(Request $request){
		if( $request->user()->level == 'admin' ){
			$profile = School::find(1);
			return view('admin.profile.edit')->withPost($profile);
		} else {
			return view('error.restricted');
		}
	}

	// Update data profil
	public function update(Request $request){
		// Validasi
		$this->validate($request, array(
			'nama_sekolah'		=> 'required|max:255',
			'kepala_sekolah'	=> 'required|max:255',
			'alamat'				=> 'required|max:255',
			'telepon'			=> 'required|numeric',
			'email'				=> 'required|max:255',
			'website'			=> 'required|max:255'
		));

		// Simpan data baru 
		$school = School::find(1);
		$school->timestamps 		= false;
		$school->nama_sekolah 	= $request->input('nama_sekolah');
		$school->kepala_sekolah	= $request->input('kepala_sekolah');
		$school->alamat			= $request->input('alamat');
		$school->telepon			= $request->input('telepon');
		$school->email 			= $request->input('email');
		$school->website 			= $request->input('website');

		$school->save();

		// Redirect ke halaman edit dengan pesan
		$request->session()->flash('alert-success', 'Profil sekolah berhasil diupdate!');
		return redirect()->route('sekolah.index');

	}
}
