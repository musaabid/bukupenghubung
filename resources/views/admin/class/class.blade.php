@extends('main_sidebar', ['page_title' => 'Detail Kelas'])

@section('nav')
	@include('partials._nav')
@endsection

@section('sidebar')
	@include('partials._sidebar_class')
@endsection

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<h1 class="panel-title pull-left">
				{{ $data['kelas']['tingkat'] == 'kecil' ? 'TK. Kecil' : 'TK. Besar' }} - {{$data['kelas']['nama_kelas']}} ({{Helper::tahun_ajaran($data['kelas']['tahun_ajaran'])}})
			</h1>
			<div class="pull-right">
				@if(Auth::User()->level == 'admin')
					<a class="btn btn-primary" href="{{route('kelas.edit', $data['kelas']['id'])}}">Edit Kelas</a>
				@endif
			</div>
		</div>
		<div class="panel-body">
			<p>Kelas ini memiliki <strong>{{count($data['kelas']->students)}}</strong> siswa</p>
			@foreach($data['kelas']->students->chunk(4) as $row)
				<div class="row">	
					@foreach ($row as $siswa)
						<div class="col-xs-6 col-md-3">
							<div class="student-list">
								<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $siswa->foto)}}" alt="{{$siswa->nama}}">
								<h5 class="text-center">{{$siswa->nama}}</h5>
								<p class="text-center">{{Helper::usia($siswa->tanggal_lahir)}} tahun</p>
									<a href="{{route('topik.diskusi', $siswa->id)}}" class="btn btn-block btn-primary">Diskusi</a>
							</div>
						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
@endsection