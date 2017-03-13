@extends('main_full', ['page_title' => 'Registrasi', 'body_class' => 'login register'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Registrasi</h3>
				</div>
				<form role="form" method="POST" action="{{ route('register') }}">
					<div class="panel-body">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group{{ $errors->has('noinduk') ? ' has-error' : '' }}">
									<label for="noinduk">Nomor Induk</label>
									<input id="noinduk" type="text" class="form-control" name="noinduk" value="{{ old('noinduk') }}" required autofocus>
									@if ($errors->has('noinduk'))
										<span class="help-block">
											<strong>{{ $errors->first('noinduk') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
							<div class="col-xs-12 col-md-6">
								<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
									<label for="nama">Nama Lengkap</label>
									<input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
									@if ($errors->has('nama'))
										<span class="help-block">
											<strong>{{ $errors->first('nama') }}</strong>
										</span>
									@endif
								</div>
							</div>
							
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6">
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

							<div class="col-xs-12 col-md-6">
								<div class="form-group{{ $errors->has('telepon_1') ? ' has-error' : '' }}">
									<label for="telepon_1">No. Telepon / HP</label>
									<input id="telepon_1" type="text" class="form-control" name="telepon_1" value="{{ old('telepon_1') }}" required>
									@if ($errors->has('telepon_1'))
										<span class="help-block">
											<strong>{{ $errors->first('telepon_1') }}</strong>
										</span>
									@endif
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-md-6">
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

							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password-confirm">Ulangi Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>
						</div>

					</div>
					<div class="panel-footer text-right">
						<button type="submit" class="btn btn-primary">Daftar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
