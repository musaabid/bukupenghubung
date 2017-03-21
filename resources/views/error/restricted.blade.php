@extends('main', ['page_title' => 'Akses ditolak!'] )

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title">Akses ditolak!</div>
				</div>
				<div class="panel-body" id="data-body">
					<div class="alert alert-danger">Anda tidak diijinkan untuk mengakses halaman ini, silahkan login dengan hak akses lebih tinggi atau hubungi Admin.</div>
					<div class="pull-right"><a class="btn btn-primary" href="{{route('dashboard')}}">Kembali ke Dasbor</a></div>
				</div>
			</div>
		</div>
	</div>
@endsection