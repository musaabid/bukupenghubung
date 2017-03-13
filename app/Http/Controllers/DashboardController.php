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
	public function index() {
		$pagemeta = array(
			'title' 			=> 'Dashboard',
			'body_class' 	=> array( 'login' ) 
		);
		return view('dashboard/dashboard')->with('pagemeta', $pagemeta);
	}
}
