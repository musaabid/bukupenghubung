<?php

namespace App\Http\Controllers;

use App\user;
use App\classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Image;
use Carbon\Carbon;

class AdminController extends Controller{

	// Cek otentikasi login
	public function __construct(){
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request){

		if( ! empty( $request->l ) ){
			if( $request->l == 'guru' ){
				$data['users'] = User::where('level', 'admin')->orWhere('level', 'guru')->get();
				$data['page_title'] = 'Admin & Guru';
			} else {
				$data['users'] = User::where('level', $request->l)->get();
				$data['page_title'] = 'Siswa';
			}
		} else {
			$data['users'] = User::all();
			$data['page_title'] = 'Semua User';
		}

		return view('admin.admin.admins')->with( 'data', $data );
	}

	// Halaman tambah user
	public function create(){
		$data['classrooms'] = Classroom::orderBy('nama_kelas')->get();
		return view('admin.admin.create')->with('data', $data);
	}

	// Proses add data ke database
	public function store(Request $request){

		// Validate data
		$this->validate($request, array(
			'level'				=> 'required|in:admin,guru,siswa',
			'noinduk'			=> 'required|integer',
			'password'			=> 'required|min:6|confirmed',
			'foto'				=> 'mimes:jpeg,png',
			'nama'				=> 'required|max:255',
			'nama_panggilan'	=> 'required|max:255',
			'jenis_kelamin'	=> 'required',
			'tempat_lahir'		=> 'required|max:255',
			'tanggal_lahir'	=> 'required|date_format:d-m-Y',
			'agama'				=> 'required|max:20',
			'alamat'				=> 'required|max:255',
			'telepon_1'			=> 'required|max:255',
			'noktp'				=> 'required_if:level,admin|required_if:level,guru',
			'status_pegawai'	=> 'required_if:level,admin|required_if:level,guru',
			'nama_ayah'			=> 'required_if:level,siswa',
			'pekerjaan_ayah'	=> 'required_if:level,siswa',
			'nama_ibu'			=> 'required_if:level,siswa',
			'pekerjaan_ibu'	=> 'required_if:level,siswa'
		));

		// Input data ke database table
		$user = new User;
		$user->level 				= $request->level;
		$user->noinduk				= $request->noinduk;
		$user->id_kelas			= $request->id_kelas;
		$user->password			= bcrypt( $request->password );

		$user->nama					= $request->nama;
		$user->nama_panggilan	= $request->nama_panggilan;
		$user->jenis_kelamin		= $request->jenis_kelamin;
		$user->tempat_lahir		= $request->tempat_lahir;

		$user->tanggal_lahir		= Carbon::createFromFormat('d-m-Y', $request->tanggal_lahir)->toDateString();
		
		$user->agama 				= $request->agama;
		$user->alamat 				= $request->alamat;
		$user->telepon_1			= $request->telepon_1;
		$user->telepon_2			= $request->telepon_2;
		$user->noktp				= $request->noktp;
		$user->status_pegawai	= $request->status_pegawai;
		$user->nama_ayah			= $request->nama_ayah;
		$user->pekerjaan_ayah	= $request->pekerjaan_ayah;
		$user->nama_ibu			= $request->nama_ibu;
		$user->pekerjaan_ibu		= $request->pekerjaan_ibu;
		$user->nama_wali			= $request->nama_wali;
		$user->pekerjaan_wali	= $request->pekerjaan_wali;
		$user->hubungan_wali		= $request->hubungan_wali;

		// Upload foto
		if($request->hasFile('foto')){
			$foto = $request->file('foto');
			$filename = time() . '_' . $user->noinduk . '.' . $foto->getClientOriginalExtension();
			Image::make($foto)->resize(200, 200)->save( public_path('uploads/avatars/' . $filename) );
			$user->foto = $filename;
		}
		
		$user->save();

		// Redirect ke halaman utama admin dengan pesan
		$request->session()->flash('alert-success', 'Berhasil menambah user!');
		return redirect()->route('admin.index');
	}

	// Halaman menampilkan 1 data, redirect ke index
	public function show($id){
		return redirect()->route('admin.edit', $id);
	}

	// Halaman edit
	public function edit($id){
		$user = User::find($id);
		$data['classrooms'] = Classroom::orderBy('nama_kelas')->get();
		$data['tanggal_lahir'] = Carbon::parse($user->tanggal_lahir)->format('d-m-Y');

		return view('admin.admin.edit')->with('data', $data)->withPost($user);
	}

	// Proses update data
	public function update(Request $request, $id){

		// Validasi
		$this->validate($request, array(
			'level'				=> 'required|in:admin,guru,siswa',
			'noinduk'			=> 'required|integer',
			'nama'				=> 'required|max:255',
			'nama_panggilan'	=> 'required|max:255',
			'jenis_kelamin'	=> 'required',
			'tempat_lahir'		=> 'required|max:255',
			'tanggal_lahir'	=> 'required|date_format:d-m-Y',
			'agama'				=> 'required|max:20',
			'alamat'				=> 'required|max:255',
			'telepon_1'			=> 'required|max:255',
			'noktp'				=> 'required_if:level,admin|required_if:level,guru',
			'status_pegawai'	=> 'required_if:level,admin|required_if:level,guru',
			'nama_ayah'			=> 'required_if:level,siswa',
			'pekerjaan_ayah'	=> 'required_if:level,siswa',
			'nama_ibu'			=> 'required_if:level,siswa',
			'pekerjaan_ibu'	=> 'required_if:level,siswa'
		));

		if( ! empty( $request->input( 'password' ) ) ) {
			$this->validate($request, array(
				'password' => 'min:6|confirmed',
			));
		}

		// Simpan data baru 
		$user = User::find($id);

		$user->level 				= $request->input('level');
		$user->noinduk				= $request->input('noinduk');
		$user->id_kelas 			= $request->input('id_kelas');
		
		if( ! empty( $request->input('password') ) ){
			$user->password			= bcrypt( $request->input('password') );
		}

		$user->nama					= $request->input('nama');
		$user->nama_panggilan	= $request->input('nama_panggilan');
		$user->jenis_kelamin		= $request->input('jenis_kelamin');
		$user->tempat_lahir		= $request->input('tempat_lahir');

		$user->tanggal_lahir		= Carbon::createFromFormat( 'd-m-Y', $request->input('tanggal_lahir') )->toDateString();
		
		$user->agama 				= $request->input('agama');
		$user->alamat 				= $request->input('alamat');
		$user->telepon_1			= $request->input('telepon_1');
		$user->telepon_2			= $request->input('telepon_2');
		$user->noktp				= $request->input('noktp');
		$user->status_pegawai	= $request->input('status_pegawai');
		$user->nama_ayah			= $request->input('nama_ayah');
		$user->pekerjaan_ayah	= $request->input('pekerjaan_ayah');
		$user->nama_ibu			= $request->input('nama_ibu');
		$user->pekerjaan_ibu		= $request->input('pekerjaan_ibu');
		$user->nama_wali			= $request->input('nama_wali');
		$user->pekerjaan_wali	= $request->input('pekerjaan_wali');
		$user->hubungan_wali		= $request->input('hubungan_wali');

		// Upload foto
		if($request->hasFile('foto')){
			$foto = $request->file('foto');
			$filename = time() . '_' . $user->noinduk . '.' . $foto->getClientOriginalExtension();
			Image::make($foto)->resize(200, 200)->save( public_path('uploads/avatars/' . $filename) );
			$user->foto = $filename;
		}
		
		$user->save();

		// Redirect ke halaman edit dengan pesan
		$request->session()->flash('alert-success', 'Data user berhasil diupdate!');
		return redirect()->route('admin.edit', $user->id);
	}

	// Proses hapus data
	public function destroy($id){
		User::destroy($id);
		Session::flash('alert-success', 'Data user berhasil dihapus!');
		return redirect()->route('admin.index');
	}

	// Proses hapus multi data
	public function bulkDestroy(Request $request){
		User::destroy($request->input('ids'));
		Session::flash('alert-success', 'Data user berhasil dihapus!');
		return response()->json([
			'success' => 'success'
		]);
	}
}
