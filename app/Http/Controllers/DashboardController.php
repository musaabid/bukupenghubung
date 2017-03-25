<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

		$pagemeta = array(
			'title' 			=> 'Dashboard',
			'body_class' 	=> array( 'login' ) 
		);
		return view('dashboard/dashboard')->with('pagemeta', $pagemeta);
	}
}
