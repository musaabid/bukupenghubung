@extends('main', ['page_title' => 'Edit User'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('admin.update', $post->id) }}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">UPDATE USER</h1>
						<div class="pull-right">
							<a href="{{route('admin.index')}}" class="btn btn-default">BATAL</a>
							<input type="submit" class="btn btn-primary" value="UPDATE">
						</div>
					</div>
					<div class="panel-body">
						
						@if( count($errors) > 0 )
							<div class="alert alert-danger" role="alert">
								<strong>Error:</strong>
								<ul>
									@foreach( $errors->all() as $error )
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
							@if(Session::has('alert-' . $msg))
								<div class="alert alert-dismissible alert-{{ $msg }}">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									{{ Session::get('alert-' . $msg) }}
								</div>
							@endif
						@endforeach

						<p>Kolom dengan tanda (<span class="required">*</span>) wajib diisi</p>

						<h3>Informasi Login</h3>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Level user </label>
									<div class="bpo-radio">
										<label class="radio-inline {{$post->level == 'admin' ? 'btn-primary' : ''}}">
											<input type="radio" name="level" id="optionadmin" value="admin" {{$post->level == 'admin' ? 'checked=""' : ''}}>
											Admin
										</label>
										<label class="radio-inline {{$post->level == 'guru' ? 'btn-primary' : ''}}">
											<input type="radio" name="level" id="optionguru" value="guru" {{$post->level == 'guru' ? 'checked=""' : ''}}>
											Guru
										</label>
										<label class="radio-inline {{$post->level == 'siswa' ? 'btn-primary' : ''}}">
											<input type="radio" name="level" id="optionmurid" value="siswa" {{$post->level == 'siswa' ? 'checked=""' : ''}}>
											Siswa
										</label>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="noinduk">Nomor Induk Pengajar / Siswa <span class="required">*</span></label>
									<input type="text" class="form-control" id="noinduk" name="noinduk" value="{{ $post->noinduk }}" data-rule-number="true" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password">Password <span class="required">*</span></label>
									<input type="password" class="form-control" id="password" minlength="6" name="password" aria-describedby="passwordHelp">
									<span id="passwordHelp" class="help-block">Kosongkan kolom password &amp; konfirmasi password jika tidak ingin merubah password.</span>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password_confirmation">Ulangi Password <span class="required">*</span></label>
									<input type="password" class="form-control" id="password_confirmation" minlength="6" equalTo="password" name="password_confirmation">
								</div>
							</div>
						</div>

						<hr />

						<h3>Informasi Guru / Siswa</h3>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="foto">Foto</label>
									<div style="margin: 5px 0 10px;"><img src="{{ asset('uploads/avatars/' . $post->foto ) }}" alt="{{$post->nama}}"></div>
									<input type="file" class="form-control" id="foto" name="foto" aria-describedby="fotoHelp" accept="image/x-png,image/jpeg">
									<span id="fotoHelp" class="help-block">Kosongkan kolom ini jika tidak ingin merubah foto.</span>
								</div>
							</div>
							<div class="col-xs-12 col-md-6" id="kelas-siswa">
								<div class="form-group">
									<label for="id_kelas">Kelas {{$post->id_kelas}}</label>
									<select name="id_kelas" class="form-control" id="id_kelas">
										<option value="" {{ empty($post->id_kelas) ? 'selected' : '' }}>- Pilih kelas -</option>
										@foreach( $data['classrooms'] as $classroom )
											<option value="{{ $classroom->id }}" {{ $post->id_kelas == $classroom->id ? 'selected' : '' }}>{{ $classroom->tingkat == 'kecil' ? 'TK. Kecil' : 'TK. Besar' }} - {{ $classroom->nama_kelas }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="nama">Nama Lengkap <span class="required">*</span></label>
									<input type="text" class="form-control" id="nama" name="nama" value="{{$post->nama}}" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="nama_panggilan">Nama Panggilan <span class="required">*</span></label>
									<input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{$post->nama_panggilan}}" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
										<option value="" {{ empty($post->jenis_kelamin) ? 'selected' : '' }}>- Pilih -</option>
										<option value="L" {{ $post->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
										<option value="P" {{ $post->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir <span class="required">*</span></label>
									<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{$post->tempat_lahir}}" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir <span class="required">*</span></label>
									<input type="text" class="form-control"  data-toggle="datepicker" id="tanggal_lahir" name="tanggal_lahir" value="{{$data['tanggal_lahir']}}" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="agama">Agama <span class="required">*</span></label>
									<select name="agama" id="agama" class="form-control" required>
										<option value="" {{ empty($post->agama) ? 'selected' : '' }}>- Pilih -</option>
										<option value="Islam" {{ $post->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
										<option value="Kristen" {{ $post->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
										<option value="Katolik" {{ $post->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
										<option value="Hindu" {{ $post->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
										<option value="Budha" {{ $post->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
										<option value="Lainnya" {{ $post->agama == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="alamat">Alamat Lengkap <span class="required">*</span></label>
									<input type="text" class="form-control" id="alamat" name="alamat" value="{{$post->alamat}}" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="telepon_1">No. Telepon <span class="required">*</span></label>
									<input type="text" class="form-control" id="telepon_1" name="telepon_1" value="{{$post->telepon_1}}" minlength="6" data-rule-number="true" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="telepon_2">No. Telepon alternatif</label>
									<input type="text" class="form-control" id="telepon_2" name="telepon_2" value="{{$post->telepon_2}}" minlength="6" data-rule-number="true">
								</div>
							</div>
						</div>

						<hr />

						<div id="data-guru">
							<h3>Informasi Tambahan Guru</h3>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="noktp">Nomor KTP</label>
										<input type="text" class="form-control" id="noktp" name="noktp" data-rule-number="true" value="{{$post->noktp}}">
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="status_pegawai">Status Pegawai</label>
										<select class="form-control" name="status_pegawai" id="status_pegawai">
											<option value="tetap" {{ $post->status_pegawai == 'tetap' ? 'selected' : '' }}>Tetap</option>										
											<option value="kontrak" {{ $post->status_pegawai == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
											<option value="magang" {{ $post->status_pegawai == 'magang' ? 'selected' : '' }}>Magang</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div id="data-ortu">						
							<h3>Informasi Orang Tua / Wali Siswa</h3>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="nama_ayah">Nama Ayah Kandung <span class="required">*</span></label>
										<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{$post->nama_ayah}}" required>
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="pekerjaan_ayah">Pekerjaan Ayah <span class="required">*</span></label>
										<input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{$post->pekerjaan_ayah}}" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="nama_ibu">Nama Ibu Kandung <span class="required">*</span></label>
										<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{$post->nama_ibu}}" required>
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="pekerjaan_ibu">Pekerjaan Ibu <span class="required">*</span></label>
										<input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{$post->pekerjaan_ibu}}" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="nama_wali">Nama Wali</label>
										<input type="text" class="form-control" id="nama_wali" name="nama_wali" value="{{$post->nama_wali}}">
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="pekerjaan_wali">Pekerjaan Wali</label>
										<input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali" value="{{$post->pekerjaan_wali}}">
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="hubungan_wali">Hubungan Dengan Wali</label>
										<input type="text" class="form-control" id="hubungan_wali" name="hubungan_wali" value="{{$post->hubungan_wali}}">
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="panel-heading clearfix">
						<div class="pull-right">
							<a href="{{route('admin.index')}}" class="btn btn-default">BATAL</a>
							<input type="submit" class="btn btn-primary" value="UPDATE">
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
@endsection