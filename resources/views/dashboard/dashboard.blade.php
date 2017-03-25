@extends('main_sidebar')

@section('nav')
	@include('partials._nav')
@endsection

@section('sidebar')
	@if (Auth::User())
		@if( Auth::User()->level == 'admin' || Auth::User()->level == 'guru' )
			@include('partials._sidebar_guru')
		@elseif( Auth::User()->level == 'siswa' )
			@include('partials._sidebar_siswa')
		@endif
	@endif
@endsection

@section('content')
	@if (Auth::User())
		@if( Auth::User()->level == 'admin' || Auth::User()->level == 'guru' )
			@include('dashboard._guru')
		@elseif( Auth::User()->level == 'siswa' )
			@include('dashboard._siswa')
		@endif
	@endif
@endsection