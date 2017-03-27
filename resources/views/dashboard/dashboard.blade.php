@extends('main', ['page_title' => 'Dasbor', 'body_class' => 'dashboard'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	
	<script>
		window.bp = {!! json_encode([
			'agama' => array(
				'islam' 		=> $data['agama']['islam'],
				'kristen' 	=> $data['agama']['kristen'],
				'katolik' 	=> $data['agama']['katolik'],
				'hindu' 		=> $data['agama']['hindu'],
				'buddha'		=> $data['agama']['buddha'],
				'konghucu' 	=> $data['agama']['konghucu'],
				'lainnya' 	=> $data['agama']['lainnya']
			),
			'jenis_kelamin' => array(
				'l' => $data['jenis_kelamin']['l'],
				'p' => $data['jenis_kelamin']['p']
			)
		]) !!};
	</script>
	@if(Auth::User()->level == 'admin')
		<h2>Statistik Sekolah</h2>
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<a href="{{route('admin.index')}}?l=guru" class="cc-link">
					<div class="color-counter orange">
						<span class="cc-icon"><i class="fa fa-graduation-cap"></i></span>
						<span class="cc-number">{{count($data['guru'])}}</span>
						<span class="cc-label">GURU</span>
					</div>
				</a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a href="{{route('admin.index')}}?l=siswa" class="cc-link">
					<div class="color-counter green">
						<span class="cc-icon"><i class="fa fa-user-circle-o"></i></span>
						<span class="cc-number">{{count($data['siswa_sekolah'])}}</span>
						<span class="cc-label">SISWA</span>
					</div>
				</a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a href="{{route('kelas.index')}}" class="cc-link">
					<div class="color-counter asphalt">
						<span class="cc-icon"><i class="fa fa-users"></i></span>
						<span class="cc-number">{{count($data['kelas'])}}</span>
						<span class="cc-label">KELAS</span>
					</div>
				</a>
			</div>
			<div class="col-xs-6 col-md-3">
				<a href="{{route('diskusi.index')}}" class="cc-link">
					<div class="color-counter purple">
						<span class="cc-icon"><i class="fa fa-comments-o"></i></span>
						<span class="cc-number">{{count($data['diskusi_sekolah'])}}</span>
						<span class="cc-label">DISKUSI</span>
					</div>
				</a>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Agama Siswa {{Helper::nama_sekolah()}}</div>
					<div class="panel-body">
						<canvas id="chart_agama"></canvas>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-default">
					<div class="panel-heading">Jenis Kelamin Siswa {{Helper::nama_sekolah()}}</div>
					<div class="panel-body">
						<canvas id="chart_jenis_kelamin"></canvas>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="panel panel-primary clean-box">
					<div class="panel-heading">Pengumuman</div>
					<div class="panel-body">
						<ul class="list-group pengumuman">
							@foreach( $data['announcements'] as $pengumuman )
								<li class="list-group-item">
									@if( ! empty($pengumuman->id_kelas) )
										<span class="badge">Kelas {{$pengumuman->classroom->nama_kelas}}</span>
									@endif
									<span class="tgl">{{Helper::format_tanggal($pengumuman->created_at, 'd-m-Y')}}</span> - 
									{{$pengumuman->pengumuman}}
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>

		<hr />
	@endif

	<h2>Statistik Kelas {{Auth::User()->classroom->nama_kelas}}</h2>
	<div class="row">
		<div class="col-xs-12 col-md-8">
			
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<a href="{{route('kelas.show', Auth::User()->classroom->id)}}" class="cc-link">
						<div class="color-counter green">
							<span class="cc-icon"><i class="fa fa-user-circle-o"></i></span>
							<span class="cc-number">{{count($data['siswa_kelas'])}}</span>
							<span class="cc-label">SISWA KELAS {{Auth::User()->classroom->nama_kelas}}</span>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-4">
					<a href="{{route('diskusi.index')}}" class="cc-link">
						<div class="color-counter purple">
							<span class="cc-icon"><i class="fa fa-comments-o"></i></span>
							<span class="cc-number">{{count($data['diskusi_kelas'])}}</span>
							<span class="cc-label">DISKUSI</span>
						</div>
					</a>
				</div>
				<div class="col-xs-12 col-md-4">
					<div class="color-counter darkblue">
						<span class="cc-icon"><i class="fa fa-comments-o"></i></span>
						<span class="cc-number">{{count($data['diskusi_bulan'])}}</span>
						<span class="cc-label">DISKUSI BULAN INI</span>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">Diskusi Kelas {{Auth::User()->classroom->nama_kelas}}</div>
				<div class="panel-body">
					<table id="datatable_diskusi" class="table table-hover table-bordered">
						<thead>
							<tr>
								<th width="30%">Judul Diskusi</th>
								<th width="20%">Siswa</th>
								<th>Dibuat</th>
								<th>Update terakhir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach( $data['diskusi_kelas'] as $discussion )
								@php
									$unread = Helper::diskusiunread($discussion->id, Auth::User()->level == 'admin' || Auth::User()->level == 'guru' ? 'siswa' : 'guru');	
								@endphp
								<tr class="{{$unread > 0 ? 'warning' : ''}}">
									<td data-search="{{$discussion->judul_diskusi}}">
										<a href="{{route('diskusi.show', $discussion->id)}}" title="Lihat diskusi">{{ $discussion->judul_diskusi }} <span class="status-hover"><strong>{{ ! empty($unread) ? '(' . $unread . ' belum dibaca)' : ''}}</strong></span></a> 
									</td>
									<td data-search="{{$discussion->student->nama}}"><a href="{{route('diskusi.student', $discussion->student->id)}}" title="Lihat diskusi dengan {{$discussion->student->nama}}">{{$discussion->student->nama}}</a></td>
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

		</div>
		<div class="col-xs-12 col-md-4">
			<div class="list-group">
				<a href="{{route('diskusi.create')}}" class="list-group-item">Buat Diskusi Baru</a>
				<a href="{{route('pengumuman.create')}}" class="list-group-item">Buat Pengumuman Baru</a>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">Profil Guru</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . Auth::User()->foto)}}" alt="{{Auth::User()->nama}}">
					<p><strong>{{Auth::User()->nama}}</strong></p>
					<p><strong>NIP</strong>: {{ Auth::User()->noinduk }}</p>
					<p><strong>Telepon</strong>:<br />{{Auth::User()->telepon_1}} {{!empty(Auth::User()->telepon_2) ? '/ ' . Auth::User()->telepon_2 : ''}}</p>
					<p><strong>Alamat</strong>:<br />{{Auth::User()->alamat}}</p>
					<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{Auth::User()->tempat_lahir}}, {{Helper::format_tanggal(Auth::User()->tanggal_lahir, 'd-m-Y')}}</p>
				</div>
			</div>
		</div>
	</div>
	
@endsection