@extends('main')

@section('nav')
	@include('partials._nav')
@endsection

@section('content')

	@if(Auth::User()->level == 'siswa')
		<div class="row">
			<div class="col-xs-12 col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">SISWA</div>
					<div class="panel-body">
						<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $data['student']->foto)}}" alt="{{$data['student']->nama}}">
						<p><strong>{{$data['student']->nama}}</strong> ({{$data['student']->nama_panggilan}})</p>
						<p><strong>NIP</strong>: {{ $data['student']->noinduk }}</p>
						<p><strong>Telepon</strong>:<br />{{$data['student']->telepon_1}} {{!empty($data['student']->telepon_2) ? '/ ' . $data['student']->telepon_2 : ''}}</p>
						<p><strong>Alamat</strong>:<br />{{$data['student']->alamat}}</p>
						<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{$data['student']->tempat_lahir}}, {{Helper::format_tanggal($data['student']->tanggal_lahir, 'd-m-Y')}}</p>
						<p><strong>Orang tua (Ibu/Ayah)</strong>:<br />{{$data['student']->nama_ibu}} {{empty($data['student']->nama_ayah) ? '' : ' / ' . $data['student']->nama_ayah}}</p>
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">WALI KELAS</div>
					<div class="panel-body">
						<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $data['teacher']->foto)}}" alt="{{$data['teacher']->nama}}">
						<p><strong>{{$data['teacher']->nama}}</strong></p>
						<p><strong>NIP</strong>: {{ $data['teacher']->noinduk }}</p>
						<p><strong>Telepon</strong>:<br />{{$data['teacher']->telepon_1}} {{!empty($data['teacher']->telepon_2) ? '/ ' . $data['teacher']->telepon_2 : ''}}</p>
						<p><strong>Alamat</strong>:<br />{{$data['teacher']->alamat}}</p>
						<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{$data['teacher']->tempat_lahir}}, {{Helper::format_tanggal($data['teacher']->tanggal_lahir, 'd-m-Y')}}</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-9">
	@endif

	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			@if(Auth::User()->level == 'admin' || Auth::User()->level == 'guru')
				<h1 class="panel-title pull-left">DISKUSI DENGAN ORANG TUA {{strtoupper($data['student']->nama)}}</h1>
			@else
				<h1 class="panel-title pull-left">DISKUSI DENGAN WALI KELAS {{strtoupper($data['student']->kelas->nama_kelas)}} - {{strtoupper($data['student']->kelas->teacher->nama)}}</h1>
			@endif

			<div class="pull-right">
				@if(Auth::User()->level == 'guru')
					<a href="{{route('diskusi.create')}}" class="btn btn-primary">Buat Diskusi</a>
				@endif
			</div>
		</div>
		<div class="panel-body">
			@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				@if(Session::has('alert-' . $msg))
					<div class="alert alert-dismissible alert-{{ $msg }}">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('alert-' . $msg) }}
					</div>
				@endif
			@endforeach
			<table id="datatable_diskusi_siswa" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th width="40%">Judul</th>
						<th>Dibuat</th>
						<th>Update terakhir</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $data['discussions'] as $discussion )
						<tr>
							<td data-search="{{$discussion->judul_diskusi}}">
								<a href="{{route('diskusi.show', $discussion->id)}}" title="Lihat diskusi">{{ $discussion->judul_diskusi }}</a>
							</td>
							<td data-order="{{ $discussion->created_at }}">{{ Helper::humantime( $discussion->created_at ) }}</td>
							<td data-order="{{ $discussion->updated_at }}">{{ empty($discussion->updated_at) ? '-' : Helper::humantime( $discussion->updated_at ) }}</td>
							<td>
								@if(Auth::User()->level == 'admin' || Auth::User()->id == $discussion->id_wali_kelas)
									<form style="display: inline;" action="{{route('diskusi.destroy', $discussion->id)}}" method="POST" class="deleteForm">
										<input type="hidden" name="_method" value="DELETE">
										{{ csrf_field() }}
										<button type="submit" title="Hapus diskusi" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
									</form>
								@else 
									-
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	@if(Auth::User()->level == 'siswa')
			</div>
		</div>
	@endif

@endsection