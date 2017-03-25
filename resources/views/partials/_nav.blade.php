		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<!-- Branding Image -->
					<a class="navbar-brand" href="{{route('dashboard')}}">
						{{Helper::nama_sekolah()}}
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">

						@if(Auth::User()->level == 'admin' || Auth::User()->level == 'guru')
							<li><a href="{{route('dashboard')}}">Dasbor</a></li>

							<li class="{{ Request::is('admin') || Request::is('admin/*') || Request::is('admin/*/edit') ? 'active' : '' }}">
								<a href="{{route('admin.index')}}">User</a>
							</li>
							
							<li class="{{ Request::is('kelas') || Request::is('kelas/*') || Request::is('kelas/*/edit') ? 'active' : '' }}">
								<a href="{{route('kelas.index')}}" >Kelas</a>
							</li>
						@endif
						
						<li class="{{ Request::is('pengumuman') || Request::is('pengumuman/*') || Request::is('pengumuman/*/edit') ? 'active' : '' }}">
							<a href="{{route('pengumuman.index')}}" >Pengumuman</a>
						</li>

						@if(Auth::User()->level == 'siswa')
							<li class="{{ Request::is('diskusi') || Request::is('diskusi/*') || Request::is('diskusi/*/siswa') ? 'active' : '' }}">
								<a href="{{route('diskusi.student', Auth::User()->id)}}" >Diskusi</a>
							</li>
						@else
							<li class="{{ Request::is('diskusi') || Request::is('diskusi/*') || Request::is('diskusi/*/siswa') ? 'active' : '' }}">
								<a href="{{route('diskusi.index')}}" >Diskusi</a>
							</li>
						@endif

						@if( Auth::User()->level == 'admin' )								
							<li class="{{ Request::is('profil-sekolah') ? 'active' : '' }}">
								<a href="{{route('sekolah.index')}}">Profil Sekolah</a>
							</li>
						@endif

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::User())

							<!-- <li><a href="#"><i class="fa fa-bell-o fa-lg"></i> <span class="badge">14</span></a></li> -->
							<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="14 diskusi aktif"><i class="fa fa-book fa-lg"></i> <span class="badge">14</span></a></li>
							<li class="dropdown menu-with-icon">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<span class="nav-profile"><img src="{{ asset('uploads/avatars/' . Auth::User()->foto ) }}" alt="{{ Auth::User()->nama }}"></span> 
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu" role="menu">
									<li class="disabled"><a href="{{ route('admin.edit', Auth::User()->id) }}">{{ Auth::User()->nama }} ({{Auth::User()->level}})</a></li>
									<li><a href="{{ route('admin.edit', Auth::User()->id) }}">Edit Akun</a></li>
									<li>
										<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>