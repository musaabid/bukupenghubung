<?php

namespace App\Http\Controllers;

use App\User;
use App\Classroom;
use App\Discussion;
use App\Announcement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		if($request->user()->level == 'siswa'){
			return redirect()->route('diskusi.student', $request->user()->id);
		}

		$data = array(
			'title' 			=> 'Dashboard',
			'body_class' 	=> array( 'login' ) 
		);

		$data['announcements'] 			= Announcement::orderBy('created_at', 'desc')->get();

		$data['agama']['islam'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'islam']])->count();
		$data['agama']['kristen'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'kristen']])->count();
		$data['agama']['katolik'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'katolik']])->count();
		$data['agama']['hindu'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'hindu']])->count();
		$data['agama']['buddha'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'buddha']])->count();
		$data['agama']['konghucu'] = User::where([['level', '=','siswa'], ['agama', '=', 'konghucu']])->count();
		$data['agama']['lainnya'] 	= User::where([['level', '=','siswa'], ['agama', '=', 'lainnya']])->count();

		$data['jenis_kelamin']['l'] 	= User::where([['level', '=','siswa'], ['jenis_kelamin', '=', 'l']])->count();
		$data['jenis_kelamin']['p'] 	= User::where([['level', '=','siswa'], ['jenis_kelamin', '=', 'p']])->count();

		$data['guru'] 					= User::where('level', 'admin')->orWhere('level', 'guru')->get();
		$data['siswa_sekolah'] 		= User::where('level', 'siswa')->get();
		$data['kelas'] 				= Classroom::get();
		$data['diskusi_sekolah']	= Discussion::where([
			['pengirim', '=', 'guru'],
			['id_parent', '=', 0]
		])->get();

		// Kalau wali kelas
		if( count($request->user()->classroom) > 0 ) {
			$data['diskusi_kelas'] = Discussion::where([
				['pengirim', '=', 'guru'],
				['id_wali_kelas', '=', $request->user()->id],
				['id_parent', '=', 0]
			])->get();

			$now = Carbon::now();

			$data['diskusi_bulan'] = Discussion::where([
				['pengirim', '=', 'guru'],
				['id_wali_kelas', '=', $request->user()->id],
				['id_parent', '=', 0]
			])->whereMonth('created_at', $now->month)->get();

			$data['siswa_kelas'] = User::where([['level', '=', 'siswa'], ['id_kelas', '=', $request->user()->classroom->id]])->get();
		}

		return view('dashboard/dashboard')->with('data', $data);
	}
}
