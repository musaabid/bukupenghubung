			<div class="panel panel-primary">
				<div class="panel-heading">Wali Kelas</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . $data['kelas']->teacher->foto)}}" alt="{{$data['kelas']->teacher->nama}}">
						<p><strong>{{$data['kelas']->teacher->nama}}</strong></p>
						<p><strong>NIP</strong>: {{ $data['kelas']->teacher->noinduk }}</p>
						<p><strong>Telepon</strong>:<br />{{$data['kelas']->teacher->telepon_1}} {{!empty($data['kelas']->teacher->telepon_2) ? '/ ' . $data['kelas']->teacher->telepon_2 : ''}}</p>
						<p><strong>Alamat</strong>:<br />{{$data['kelas']->teacher->alamat}}</p>
						<p><strong>Tempat &amp; tanggal lahir</strong>:<br />{{$data['kelas']->teacher->tempat_lahir}}, {{Helper::format_tanggal($data['kelas']->teacher->tanggal_lahir, 'd-m-Y')}}</p>
				</div>
			</div>
			
			<div class="list-group">
				<a href="{{route('topik.create')}}" class="list-group-item">Buat Topik Baru</a>
				<a href="{{route('pengumuman.create')}}" class="list-group-item">Buat Pengumuman Baru</a>
			</div>