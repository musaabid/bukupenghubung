@extends('main', ['page_title' => 'Edit Profil Sekolah'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('sekolah.update') }}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">PROFIL SEKOLAH</h1>
						<div class="pull-right">
							<input type="submit" class="btn btn-primary" value="UPDATE">
						</div>
					</div>
					<div class="panel-body">
						
						@if( count($errors) > 0 )
							<div class="alert alert-danger" role="alert">
								<strong>Error:</strong>
								<ul>
									@foreach( $errors->all() as $error )
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							@if(Session::has('alert-' . $msg))
								<div class="alert alert-dismissible alert-{{ $msg }}">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									{{ Session::get('alert-' . $msg) }}
								</div>
							@endif
						@endforeach

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="nama_sekolah">Nama Sekolah <span class="required">*</span></label>
									<input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{$post->nama_sekolah}}" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="kepala_sekolah">Nama Kepala Sekolah <span class="required">*</span></label>
									<input type="text" class="form-control" id="kepala_sekolah" name="kepala_sekolah" value="{{$post->kepala_sekolah}}" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="alamat">Alamat Lengkap <span class="required">*</span></label>
									<input type="text" class="form-control" id="alamat" name="alamat" value="{{$post->alamat}}" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-4">
								<div class="form-group">
									<label for="telepon">No. Telepon <span class="required">*</span></label>
									<input type="text" class="form-control" id="telepon" name="telepon" value="{{$post->telepon}}" minlength="6" data-rule-number="true" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div class="form-group">
									<label for="email">E-Mail</label>
									<input type="text" class="form-control" id="email" name="email" value="{{$post->email}}">
								</div>
							</div>
							<div class="col-xs-12 col-md-4">
								<div class="form-group">
									<label for="website">Website</label>
									<input type="text" class="form-control" id="website" name="website" value="{{$post->website}}">
								</div>
							</div>
						</div>

					</div>

					<div class="panel-heading clearfix">
						<div class="pull-right">
							<input type="submit" class="btn btn-primary" value="UPDATE">
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
@endsection