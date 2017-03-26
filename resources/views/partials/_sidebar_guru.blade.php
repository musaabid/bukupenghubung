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
			
			<div class="list-group">
				<a href="{{route('diskusi.create')}}" class="list-group-item">Buat Diskusi Baru</a>
				<a href="{{route('pengumuman.create')}}" class="list-group-item">Buat Pengumuman Baru</a>
			</div>