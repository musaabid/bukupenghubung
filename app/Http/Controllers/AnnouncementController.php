<?php

namespace App\Http\Controllers;

use App\User;
use App\Classroom;
use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{

	// Cek otentikasi login
	public function __construct(){
		$this->middleware('auth');
	}

	// Halaman semua pengumuman
	public function index(){
		$data['announcements'] = Announcement::all();
		return view('admin.announcement.announcements')->with( 'data', $data );
	}

	// Halaman tambah pengumuman
	public function create(Request $request){
		if( ( $request->user()->level == 'admin' ) || ( $request->user()->level == 'guru' && count($request->user()->classroom) > 0 ) ){
			$data['classes'] = Classroom::where('id_wali_kelas', $request->user()->id)->get();
			return view('admin.announcement.create')->with('data', $data);
		} else {
			return view('error.restricted');
		}
	}

	// Fungsi tambah pengumuman
	public function store(Request $request){
		if( ( $request->user()->level == 'admin' ) || ( $request->user()->level == 'guru' && count($request->user()->classroom) > 0 ) ){

			// Validate data
			$this->validate($request, array(
				'id_author'			=> 'required',
				'pengumuman'		=> 'required',
			));

			// Input data ke database table
			$announcement = new Announcement;
			$announcement->id_author 	= $request->user()->id;
			$announcement->id_kelas 	= $request->id_kelas;
			$announcement->pengumuman	= $request->pengumuman;
			
			$announcement->save();

			$request->session()->flash('alert-success', 'Berhasil menambah pengumuman!');

			// Redirect
			return redirect()->route('pengumuman.index');
		} else {
			return view('error.restricted');
		}
	}

	// Menampilkan satu pengumuman, redirect ke halaman semua pengumuman
	public function show($id){
		return view('admin.announcement.announcements');
	}

	// Halaman edit pengumuman
	public function edit($id){
		return view('admin.announcement.announcements');
	}

	// Fungsi update pengumuman
	public function update(Request $request, $id){
		return view('admin.announcement.announcements');
	}

	// Fungsi hapus pengumuman
	public function destroy(Request $request, $id){
		$pengumuman = Announcement::find($id);
		if($request->user()->level == 'admin' || ($request->user()->level == 'guru' && $request->user()->id == $pengumuman->id_author) ){
			Announcement::destroy($id);
			Session::flash('alert-success', 'Pengumuman berhasil dihapus!');
			return redirect()->route('pengumuman.index');
		} else {
			return view('error.restricted');
		}
	}

	// Proses hapus multi data
	public function bulkDestroy(Request $request){
		if($request->user()->level == 'admin'){
			Announcement::destroy($request->input('ids'));
			Session::flash('alert-success', 'Pengumuman berhasil dihapus!');
			return response()->json([
				'success' => 'success'
			]);
		} else {
			return view('error.restricted');
		}
	}
}
