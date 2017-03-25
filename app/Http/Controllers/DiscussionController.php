<?php

namespace App\Http\Controllers;

use \Auth;
use App\User;
use App\School;
use App\Classroom;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscussionController extends Controller{

	// Cek otentikasi login
	public function __construct(){
		$this->middleware('auth');
	}

	// Halamam diskusi khusus guru
	public function index(Request $request){
		if( ( $request->user()->level == 'admin' || $request->user()->level == 'guru') && count($request->user()->classroom) > 0 ){
			$data['discussions'] = Discussion::where([
				['id_parent', '=', 0],
				['id_wali_kelas', '=', $request->user()->id]
			])->get();
			return view('admin.discussion.discussions')->with('data', $data);
		} else {
			return view('error.restricted');
		}
	}

	// Halamam diskusi dengan satu siswa
	public function withstudent(Request $request, $id){
		if( ($request->user()->level == 'siswa') || ( $request->user()->level == 'admin' || $request->user()->level == 'guru') && count($request->user()->classroom) > 0 ){
			$data['student'] = User::find($id);
			if($request->user()->level == 'admin' || $request->user()->level == 'guru'){
				$data['discussions'] = Discussion::where([
					['id_parent', '=', 0],
					['id_wali_kelas', '=', $request->user()->id],
					['id_siswa', '=', $id]
				])->get();
				$data['teacher'] = User::find($request->user()->id);
			} elseif($request->user()->level == 'siswa') {
				$data['discussions'] = Discussion::where([
					['id_parent', '=', 0],
					['id_wali_kelas', '=', $data['student']->kelas->id_wali_kelas],
					['id_siswa', '=', $id]
				])->get();
				$data['teacher'] = User::find($data['student']->kelas->id_wali_kelas);
			}
			return view('admin.discussion.student')->with('data', $data);
		} else {
			return view('error.restricted');
		}
	}

	// Halaman tambah diskusi
	public function create(Request $request){
		if( ( $request->user()->level == 'admin' || $request->user()->level == 'guru') && count($request->user()->classroom) > 0 ){
			$data['students'] = User::where([
				['level', '=', 'siswa'],
				['id_kelas', '=', $request->user()->classroom->id]
			])->get();
			return view('admin.discussion.create')->with('data', $data);
		} else {
			return view('error.restricted');
		}
	}

	// Fungsi tambah kelas baru
	public function store(Request $request){
		if( ( $request->user()->level == 'admin' || $request->user()->level == 'guru') && count($request->user()->classroom) > 0 ){
			// Validate data
			$this->validate($request, array(
				'id_siswa'			=> 'required|numeric',
				'judul_diskusi'	=> 'required|max:255',
				'isi_diskusi'		=> 'required'
			));

			// Input data ke database table
			$discussion = new Discussion;
			$discussion->id_wali_kelas 	= $request->user()->id;
			$discussion->id_siswa 			= $request->id_siswa;
			$discussion->judul_diskusi 	= $request->judul_diskusi;
			$discussion->isi_diskusi 		= $request->isi_diskusi;
			
			$discussion->save();

			$request->session()->flash('alert-success', 'Berhasil membuat diskusi baru!');

			// Redirect
			return redirect()->route('diskusi.index');
		} else {
			return view('error.restricted');
		}
	}

	// Halaman detail diskusi
	public function discussion(Request $request, $id){
		$data['main_discussion'] 	= Discussion::find($id);
		$data['discussions']			= Discussion::where([
			['id_parent', '=', $id],
			['id_siswa', '=', $data['main_discussion']->id_siswa]
		])->orderBy('created_at', 'asc')->get();
		return view('admin.discussion.discussion')->with('data', $data);
		//return redirect()->route('kelas.edit', $id);
	}

	// Fungsi balas diskusi
	public function chat(Request $request, $id){

		// Input data ke database table
		$discussion = new Discussion;
		$discussion->id_parent 			= $request->input('id_parent');
		$discussion->id_wali_kelas 	= $request->input('id_wali_kelas');
		$discussion->id_siswa 			= $request->input('id_siswa');
		$discussion->pengirim			= $request->input('pengirim');
		$discussion->isi_diskusi 		= $request->input('isi_diskusi');
		
		$discussion->save();

		$parent_discussion = Discussion::find($request->input('id_parent'));
		$parent_discussion->touch();

		return response()->json([
			'success' 	=> 'success'
		]);
	
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
