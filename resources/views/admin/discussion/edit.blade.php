@extends('main', ['page_title' => 'Edit Kelas'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('kelas.update', $post->id) }}" method="POST">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">EDIT KELAS</h1>
						<div class="pull-right">
							<a href="{{route('discussion.index')}}" class="btn btn-default">BATAL</a>
							<button class="btn btn-primary">UPDATE</button>
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
							<div class="col-xs-12">
								<div class="form-group">
									<label for="nama_kelas">Nama Kelas</label>
									<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{$post->nama_kelas}}" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="id_wali_kelas">Wali Kelas</label>
									<select name="id_wali_kelas" class="form-control" id="id_wali_kelas" required>
										<option value="" {{ empty($post->id_wali_kelas) ? 'selected' : '' }}>- Pilih Wali Kelas -</option>
										@foreach( $data['teachers'] as $teacher )
											@if($teacher->id != $post->id_wali_kelas)
												@if( empty( $teacher->classroom->nama_kelas ) )
													<option value="{{ $teacher->id }}" {{ $post->id_wali_kelas == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
												@endif
											@else
												<option value="{{ $teacher->id }}" {{ $post->id_wali_kelas == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="tahun_ajaran">Tahun Ajaran</label>
									<select name="tahun_ajaran" class="form-control" id="tahun_ajaran" required>
										@foreach( $data['years'] as $year => $yearLabel )
											<option value="{{ $year }}" {{ $year == $post->tahun_ajaran ? 'selected' : '' }}>{{ $yearLabel }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="tingkat">Tingkat</label>
									<select name="tingkat" class="form-control" id="tingkat" required>
										<option value="kecil" {{$post->tingkat == 'kecil' ? 'selected' : ''}}>TK. Kecil</option>
										<option value="besar" {{$post->tingkat == 'besar' ? 'selected' : ''}}>TK. Besar</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection