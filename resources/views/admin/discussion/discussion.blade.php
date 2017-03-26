@extends('main', ['page_title' => 'Detail diskusi'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	
	<script>
		window.bp = {!! json_encode([
			'chatRoute' 		=> route('diskusi.chat', $data['main_discussion']->id),
			'id_parent'			=> $data['main_discussion']->id,
			'id_wali_kelas'	=> $data['main_discussion']->teacher->id,
			'id_siswa'			=> $data['main_discussion']->student->id,
			'pengirim'			=> Auth::User()->level == 'siswa' ? 'siswa' : 'guru'
		]) !!};
	</script>

	<div class="row">
		<div class="col-xs-12 col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">WALI KELAS</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $data['main_discussion']->teacher->foto)}}" alt="{{$data['main_discussion']->teacher->nama}}">
					<p><strong>{{$data['main_discussion']->teacher->nama}}</strong></p>
					<p><strong>NIP</strong>: {{ $data['main_discussion']->teacher->noinduk }}</p>
					<p><strong>Telepon</strong>:<br />{{$data['main_discussion']->teacher->telepon_1}} {{!empty($data['main_discussion']->teacher->telepon_2) ? '/ ' . $data['main_discussion']->teacher->telepon_2 : ''}}</p>
					<p><strong>Alamat</strong>:<br />{{$data['main_discussion']->teacher->alamat}}</p>
					<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{$data['main_discussion']->teacher->tempat_lahir}}, {{Helper::format_tanggal($data['main_discussion']->teacher->tanggal_lahir, 'd-m-Y')}}</p>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading clearfix">
					<h1 class="panel-title pull-left">Hal: {{$data['main_discussion']->judul_diskusi}}</h1>
				</div>
				<div class="panel-body" style="padding: 0">
					<div class="topic">
						<div class="discussion-pp"><img class="img-responsive" src="{{asset('uploads/avatars/' . $data['main_discussion']->teacher->foto)}}" alt="{{$data['main_discussion']->teacher->nama}}"></div> {{$data['main_discussion']->isi_diskusi}}
					</div>
					<div id="discussions" class="discussions">
						@foreach($data['discussions'] as $diskusi)
							<div class="discussion-item clearfix">
								@php
									$foto = $diskusi->pengirim == 'guru' ? $diskusi->teacher->foto : $diskusi->student->foto;
								@endphp
								<div class="discussion-pp {{$diskusi->pengirim == 'guru' ? 'pull-left' : 'pull-right'}}"><img class="img-responsive" src="{{asset('uploads/avatars/' . $foto)}}" alt="{{$diskusi->pengirim == 'guru' ? $diskusi->teacher->nama : $diskusi->student->nama}}"></div>
								<div class="discussion-item-content-wrapper {{$diskusi->pengirim == 'guru' ? 'pull-left' : 'pull-right'}}">
									<div class="discussion-item-content">{{$diskusi->isi_diskusi}}</div>
									<span class="discussion-meta">{{Helper::humantime($diskusi->created_at)}}</span>
								</div>
							</div>
						@endforeach
					</div>
					<div class="discussion-form">
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<textarea class="form-control" id="discussion_content" required rows="3"></textarea>
								</div>
							</div>
						</div>
						<div class="text-right">Balas pesan sebagai: <strong>{{Auth::User()->level == 'siswa' ? 'Orang Tua Siswa' : 'Guru'}}</strong> <button id="sendDiscussion" class="btn btn-primary btn-lg">Kirim Balasan</button></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-3">
			<div class="panel panel-primary">
				<div class="panel-heading">SISWA</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $data['main_discussion']->student->foto)}}" alt="{{$data['main_discussion']->student->nama}}">
					<p><strong>{{$data['main_discussion']->student->nama}}</strong> ({{$data['main_discussion']->student->nama_panggilan}})</p>
					<p><strong>NIP</strong>: {{ $data['main_discussion']->student->noinduk }}</p>
					<p><strong>Telepon</strong>:<br />{{$data['main_discussion']->student->telepon_1}} {{!empty($data['main_discussion']->student->telepon_2) ? '/ ' . $data['main_discussion']->student->telepon_2 : ''}}</p>
					<p><strong>Alamat</strong>:<br />{{$data['main_discussion']->student->alamat}}</p>
					<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{$data['main_discussion']->student->tempat_lahir}}, {{Helper::format_tanggal($data['main_discussion']->student->tanggal_lahir, 'd-m-Y')}}</p>
					<p><strong>Orang tua (Ibu/Ayah)</strong>:<br />{{$data['main_discussion']->student->nama_ibu}} {{empty($data['main_discussion']->student->nama_ayah) ? '' : ' / ' . $data['main_discussion']->student->nama_ayah}}</p>
				</div>
			</div>
		</div>
	</div>
	
	
@endsection