@extends('main', ['page_title' => 'Lupa Password', 'body_class' => 'login reset-password'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title text-center">LUPA PASSWORD</h1>
				</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					<p>Silahkan menghubungi pihak administrasi sekolah untuk meminta password baru</p>
					<a href="{{route('login')}}" class="btn btn-primary">Kembali ke login</a> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
