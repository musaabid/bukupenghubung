@include('_head')
	@yield('nav')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@yield('content')
			</div>
		</div>
	</div>
@include('_footer')