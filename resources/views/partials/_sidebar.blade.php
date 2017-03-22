			<div class="panel panel-primary">
				<div class="panel-heading">{{ Auth::User()->nama }}</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . Auth::User()->foto)}}" alt="{{Auth::User()->nama}}">
					<ul class="list-unstyled">
						<li><strong>NIP</strong>: {{ Auth::user()->noinduk }}</li>
					</ul>
				</div>
			</div>
			
			<div class="list-group">
				<a href="{{route('diskusi.create')}}" class="list-group-item">Buat Diskusi Baru</a>
				<a href="{{route('pengumuman.create')}}" class="list-group-item">Buat Pengumuman Baru</a>
			</div>