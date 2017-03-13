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

					<form role="form" method="POST" action="{{ route('password.email') }}">
						{{ csrf_field() }}

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="email">Alamat E-Mail</label>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
									@if ($errors->has('email'))
										<span class="help-block">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6 pull-right">
								<button type="submit" class="btn btn-primary btn-block">Ganti Password</button>
							</div>
							<div class="col-xs-12 col-md-6 pull-left">
								<a class="btn btn-link btn-block" href="/login">Kembali ke Login</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
