@extends('main', ['page_title' => 'Buat diskusi baru'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('diskusi.store') }}" method="POST">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">BUAT DISKUSI BARU - KELAS {{Auth::User()->classroom->nama_kelas}}</h1>
						<div class="pull-right">
							<a href="{{route('diskusi.index')}}" class="btn btn-default">BATAL</a>
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

						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label for="id_siswa">Siswa</label>
									<select name="id_siswa" class="form-control" id="id_siswa" required>
										<option value="" selected>- Pilih Siswa -</option>
										@foreach( $data['students'] as $student )
											<option value="{{ $student->id }}">{{ $student->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-8">
								<div class="form-group">
									<label for="judul_diskusi">Judul Diskusi</label>
									<input type="text" class="form-control" id="judul_diskusi" name="judul_diskusi" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="isi_diskusi">Diskusi</label>
									<textarea class="form-control" name="isi_diskusi" id="isi_diskusi" required rows="5"></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection