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
						TKK. Tegal Jaya
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					<ul class="nav navbar-nav">
						<li><a href="{{route('dashboard')}}">Dasbor</a></li>
						<li class="{{ Request::is('admin') || Request::is('admin/*') || Request::is('admin/*/edit') ? 'active' : '' }}">
							<a href="{{route('admin.index')}}">User</a>
						</li>
						
						<li class="{{ Request::is('kelas') || Request::is('kelas/*') || Request::is('kelas/*/edit') ? 'active' : '' }}">
							<a href="{{route('kelas.index')}}" >Kelas</a>
						</li>
						
						<li class="{{ Request::is('pengumuman') || Request::is('pengumuman/*') || Request::is('pengumuman/*/edit') ? 'active' : '' }}">
							<a href="{{route('pengumuman.index')}}" >Pengumuman</a>
						</li>
						<li class="{{ Request::is('topik') || Request::is('topik/*') || Request::is('topik/*/edit') ? 'active' : '' }}">
							<a href="{{route('topik.index')}}" >Topik</a>
						</li>
						<li class="{{ Request::is('profil-sekolah') ? 'active' : '' }}">
							<a href="{{route('sekolah.index')}}">Profil Sekolah</a>
						</li>
					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						<!-- Authentication Links -->
						@if (Auth::User())

							@if( Auth::User()->level == 'super' )
								
							@endif

							<!-- <li><a href="#"><i class="fa fa-bell-o fa-lg"></i> <span class="badge">14</span></a></li> -->
							<li><a href="#" data-toggle="tooltip" data-placement="bottom" title="14 Balasan topik"><i class="fa fa-book fa-lg"></i> <span class="badge">14</span></a></li>
							<li class="dropdown menu-with-icon">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<span class="nav-profile"><img src="{{ asset('uploads/avatars/' . Auth::User()->foto ) }}" alt="{{ Auth::User()->nama }}"></span> 
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu" role="menu">
									<li class="disabled"><a href="{{ route('admin.edit', Auth::User()->id) }}">{{ Auth::User()->nama }}</a></li>
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