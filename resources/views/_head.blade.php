<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ ! empty($page_title) ? $page_title . ' : ' : '' }} {{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet">
	<link href="{{ asset('libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('libs/DataTables/datatables.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	<!-- Scripts -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
			'route'		=> Route::current()->getName()
		]) !!};
	</script>
</head>

<body class="bpo route-{{ Route::currentRouteName() }} {{ $body_class or '' }}">
	<div id="app" class="site">
		