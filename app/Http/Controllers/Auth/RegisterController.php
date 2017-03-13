<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';

	protected function showRegistrationForm(){
		return redirect()->to('/');
	}

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'noinduk'	=> 'required|integer|unique:users',
			'email'		=> 'required|email|max:255|unique:users',
			'password'	=> 'required|min:6|confirmed',
			'nama'		=> 'required|max:255',
			'telepon_1' => 'required|max:255'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'noinduk' 	=> $data['noinduk'],
			'email' 		=> $data['email'],
			'password'	=> bcrypt($data['password']),
			'level' 		=> 'admin',
			'nama'		=> $data['nama'],
			'telepon_1' => $data['telepon_1']
		]);
	}
}
