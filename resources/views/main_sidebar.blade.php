@include('_head')
	@yield('nav')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3">
				@yield('sidebar')
			</div>
			<div class="col-xs-12 col-md-9">
				@yield('content')
			</div>
		</div>
	</div>
@include('_footer')