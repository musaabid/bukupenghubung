@extends('main')

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-3">
			@include('partials._sidebar')
		</div>
		<div class="col-md-9 pull-right">
			<div class="panel panel-default">
				<div class="panel-heading">Semua pengumuman</div>

				<div class="panel-body">
					Menampilkan semua pengumuman
				</div>
			</div>
		</div>
	</div>
</div>
@endsection