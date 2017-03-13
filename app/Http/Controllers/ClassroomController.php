<?php

namespace App\Http\Controllers;

use App\User;
use App\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassroomController extends Controller
{

	// Cek otentikasi login
	public function __construct(){
		$this->middleware('auth');
	}

	// Halaman semua kelas
	public function index(){

		$data['classrooms'] = Classroom::all();
		return view('admin.class.classes')->with( 'data', $data );
	}

	// Halaman tambah kelas
	public function create(){

		// Daftar tahun ajaran
		$years = range ( date( 'Y' ), date( 'Y') + 10 );
		foreach ( $years as $year ){
			$dateString = $year. '-01-01 09:09:09';
			$t = strtotime($dateString);
			$t2 = strtotime('+1 year', $t);
			$data['years'][$year] = $year . ' / ' . date( 'Y', $t2 );
		}

		// Daftar wali kelas
		$data['teachers'] = User::where('level', 'admin')->orWhere('level', 'guru')->orderBy('nama')->get();

		return view('admin.class.create')->with( 'data', $data );
	}

	// Tambah kelas baru
	public function store(Request $request){

		// Validate data
		$this->validate($request, array(
			'id_wali_kelas'	=> 'required|integer',
			'nama_kelas'		=> 'required|max:255',
			'tahun_ajaran'		=> 'required|integer',
			'tingkat'			=> 'required|in:kecil,besar'
		));

		// Input data ke database table
		$class = new Classroom;
		$class->id_wali_kelas 	= $request->id_wali_kelas;
		$class->nama_kelas 		= $request->nama_kelas;
		$class->tahun_ajaran 	= $request->tahun_ajaran;
		$class->tingkat 			= $request->tingkat;
		
		$class->save();

		$request->session()->flash('alert-success', 'Berhasil menambah kelas!');

		// Redirect
		return redirect()->route('kelas.index');

	}

	// Halaman detail 1 kelas
	public function show($id){
		//return view('admin.class.class');
		return redirect()->route('kelas.edit', $id);
	}

	// Halaman edit kelas
	public function edit($id){

		// Data kelas
		$classroom = Classroom::find($id);

		// Daftar tahun ajaran
		$years = range ( date( 'Y' ), date( 'Y') + 10 );
		foreach ( $years as $year ){
			$dateString = $year. '-01-01 09:09:09';
			$t = strtotime($dateString);
			$t2 = strtotime('+1 year', $t);
			$data['years'][$year] = $year . ' / ' . date( 'Y', $t2 );
		}

		// Daftar wali kelas
		$data['teachers'] = User::where('level', 'admin')->orWhere('level', 'guru')->orderBy('nama')->get();

		return view('admin.class.edit')->with('data', $data)->withPost($classroom);
	}

	// Update data kelas
	public function update(Request $request, $id){
		// Validasi
		$this->validate($request, array(
			'id_wali_kelas'	=> 'required|integer',
			'nama_kelas'		=> 'required|max:255',
			'tahun_ajaran'		=> 'required|integer',
			'tingkat'			=> 'required|in:kecil,besar'
		));

		// Simpan data baru 
		$classroom = Classroom::find($id);
		$classroom->id_wali_kelas 		= $request->input('id_wali_kelas');
		$classroom->nama_kelas			= $request->input('nama_kelas');
		$classroom->tahun_ajaran		= $request->input('tahun_ajaran');
		$classroom->tingkat				= $request->input('tingkat');

		$classroom->save();

		// Redirect ke halaman edit dengan pesan
		$request->session()->flash('alert-success', 'Data kelas berhasil diupdate!');
		return redirect()->route('kelas.edit', $classroom->id);

	}

	// Hapus data
	public function destroy($id){
		Classroom::destroy($id);
		Session::flash('alert-success', 'Data kelas berhasil dihapus!');
		return redirect()->route('kelas.index');
	}

	// Proses hapus multi data
	public function bulkDestroy(Request $request){
		Classroom::destroy($request->input('ids'));
		Session::flash('alert-success', 'Data kelas berhasil dihapus!');
		return response()->json([
			'success' => 'success'
		]);
	}
	
}
