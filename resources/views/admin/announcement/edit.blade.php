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
				<div class="panel-heading">Edit pengumuman</div>

				<div class="panel-body">
					Form untuk edit pengumuman
				</div>
			</div>
		</div>
	</div>
</div>
@endsection