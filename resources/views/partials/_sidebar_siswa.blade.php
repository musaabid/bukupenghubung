			<div class="panel panel-primary">
				<div class="panel-heading">Profil Siswa</div>
				<div class="panel-body">
					<img style="width:100%; margin-bottom: 20px;" class="img-responsive" src="{{asset('uploads/avatars/' . Auth::User()->foto)}}" alt="{{Auth::User()->nama}}">
					<p><strong>{{Auth::User()->nama}}</strong></p>
					<p><strong>NIS</strong>: {{Auth::User()->noinduk}}</p>
				</div>
			</div>