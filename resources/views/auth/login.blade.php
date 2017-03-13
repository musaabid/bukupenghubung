@extends('main_full', ['page_title' => 'Login', 'body_class' => 'login'])
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading"><h1 class="panel-title text-center">AKSES DASHBOARD</h1></div>
				<div class="panel-body">
					<form role="form" method="POST" action="{{ route('login') }}">
						{{ csrf_field() }}

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group{{ $errors->has('noinduk') ? ' has-error' : '' }}">
									<label for="noinduk">NIP / NIS</label>
									<input id="noinduk" type="text" class="form-control" name="noinduk" value="{{ old('noinduk') }}" required autofocus>
									@if ($errors->has('noinduk'))
										<span class="help-block">
											<strong>{{ $errors->first('noinduk') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required>
									@if ($errors->has('password'))
										<span class="help-block">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<div class="checkbox">
										<label><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat Saya</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-8">
								<a class="btn btn-link" href="{{ route('password.request') }}">Lupa Password?</a>
							</div>
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary btn-block">Masuk</button>
							</div>						
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
