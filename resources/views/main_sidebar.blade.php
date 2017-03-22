@include('_head')
	@yield('nav')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-9 pull-right">
				@yield('content')
			</div>
			<div class="col-xs-12 col-md-3 pull-left">
				@yield('sidebar')
			</div>
		</div>
	</div>
@include('_footer')