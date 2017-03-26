@extends('main', ['page_title' => 'Tambah Pengumuman'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('pengumuman.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">TAMBAH PENGUMUMAN</h1>
						<div class="pull-right">
							<a href="{{route('pengumuman.index')}}" class="btn btn-default">BATAL</a>
							<button class="btn btn-primary">SIMPAN</button>
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

						<p>Pilih "Seluruh sekolah" pada kolom kelas untuk membuat pengumuman kepada seluruh siswa di sekolah, <strong>Guru</strong> hanya bisa membuat pengumuman ke kelas yang di wali-kan</p>

						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="id_author">Author</label><br />
									{{Auth::User()->nama}}
									<input type="hidden" name="id_author" value="{{Auth::User()->id}}">
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="id_kelas">Kelas</label>
									<select name="id_kelas" class="form-control" id="id_kelas">
										@if(Auth::User()->level == 'admin')
											<option value="" selected>- Seluruh Sekolah -</option>
										@endif
										@foreach( $data['classes'] as $class )
											<option value="{{$class->id}}" {{Auth::User()->level == 'guru' ? 'selected' : ''}}>{{ $class->nama_kelas }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="pengumuman">Pengumuman</label>
									<textarea name="pengumuman" id="pengumuman" class="form-control" rows="6" required></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection