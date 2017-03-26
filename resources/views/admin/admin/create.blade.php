@extends('main', ['page_title' => 'Tambah User'])

@section('nav')
	@include('partials._nav')
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12 col-md-8 col-md-offset-2">
			<form id="form" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="panel panel-default">
					<div class="panel-heading clearfix">
						<h1 class="panel-title pull-left">TAMBAH USER</h1>
						<div class="pull-right">
							<a href="{{route('admin.index')}}" class="btn btn-default">BATAL</a>
							<button class="btn btn-primary">SIMPAN</button>
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

						<p>Kolom dengan tanda (<span class="required">*</span>) wajib diisi</p>

						<h3>Informasi Login</h3>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label>Level user</label>
									<div class="bpo-radio">
										<label class="radio-inline btn-primary">
											<input type="radio" name="level" id="optionadmin" value="admin" checked="">
											Admin
										</label>
										<label class="radio-inline">
											<input type="radio" name="level" id="optionguru" value="guru">
											Guru
										</label>
										<label class="radio-inline">
											<input type="radio" name="level" id="optionmurid" value="siswa">
											Siswa
										</label>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="noinduk">Nomor Induk Pengajar / Siswa <span class="required">*</span></label>
									<input type="text" class="form-control" id="noinduk" name="noinduk" data-rule-number="true" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password">Password <span class="required">*</span></label>
									<input type="password" class="form-control" id="password" minlength="6" name="password" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="password_confirmation">Ulangi Password <span class="required">*</span></label>
									<input type="password" class="form-control" id="password_confirmation" minlength="6" equalTo="password" name="password_confirmation" required>
								</div>
							</div>
						</div>

						<hr />

						<h3>Informasi Guru / Siswa</h3>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="foto">Foto</label>
									<input type="file" class="form-control" id="foto" name="foto" accept="image/x-png,image/jpeg">
								</div>
							</div>
							<div class="col-xs-12 col-md-6" id="kelas-siswa">
								<div class="form-group">
									<label for="id_kelas">Kelas</label>
									<select name="id_kelas" class="form-control" id="id_kelas">
										<option value="">- Pilih kelas -</option>
										@foreach( $data['classrooms'] as $classroom )
											<option value="{{ $classroom->id }}">{{ $classroom->tingkat == 'kecil' ? 'TK. Kecil' : 'TK. Besar' }} - {{ $classroom->nama_kelas }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="nama">Nama Lengkap <span class="required">*</span></label>
									<input type="text" class="form-control" id="nama" name="nama" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="nama_panggilan">Nama Panggilan <span class="required">*</span></label>
									<input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
										<option value="">- Pilih -</option>
										<option value="L">Laki-laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="tempat_lahir">Tempat Lahir <span class="required">*</span></label>
									<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="tanggal_lahir">Tanggal Lahir <span class="required">*</span></label>
									<input type="text" class="form-control"  data-toggle="datepicker" id="tanggal_lahir" name="tanggal_lahir" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-3">
								<div class="form-group">
									<label for="agama">Agama <span class="required">*</span></label>
									<select name="agama" id="agama" class="form-control" required>
										<option value="">- Pilih -</option>
										<option value="Islam">Islam</option>
										<option value="Kristen">Kristen</option>
										<option value="Katolik">Katolik</option>
										<option value="Hindu">Hindu</option>
										<option value="Buddha">Buddha</option>
										<option value="Konghucu">Konghucu</option>
										<option value="Lainnya">Lainnya</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="alamat">Alamat Lengkap <span class="required">*</span></label>
									<input type="text" class="form-control" id="alamat" name="alamat" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="telepon_1">No. Telepon <span class="required">*</span></label>
									<input type="text" class="form-control" id="telepon_1" name="telepon_1" minlength="6" data-rule-number="true" required>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="telepon_2">No. Telepon alternatif</label>
									<input type="text" class="form-control" id="telepon_2" minlength="6" data-rule-number="true" name="telepon_2">
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
										<input type="text" class="form-control" id="noktp" name="noktp" data-rule-number="true">
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="status_pegawai">Status Pegawai</label>
										<select class="form-control" name="status_pegawai" id="status_pegawai">
											<option value="tetap" selected>Tetap</option>										
											<option value="kontrak">Kontrak</option>										
											<option value="magang">Magang</option>										
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
										<input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="pekerjaan_ayah">Pekerjaan Ayah <span class="required">*</span></label>
										<input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="nama_ibu">Nama Ibu Kandung <span class="required">*</span></label>
										<input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
									</div>
								</div>
								<div class="col-xs-12 col-md-6">
									<div class="form-group">
										<label for="pekerjaan_ibu">Pekerjaan Ibu <span class="required">*</span></label>
										<input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="nama_wali">Nama Wali</label>
										<input type="text" class="form-control" id="nama_wali" name="nama_wali">
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="pekerjaan_wali">Pekerjaan Wali</label>
										<input type="text" class="form-control" id="pekerjaan_wali" name="pekerjaan_wali">
									</div>
								</div>
								<div class="col-xs-12 col-md-4">
									<div class="form-group">
										<label for="hubungan_wali">Hubungan Dengan Wali</label>
										<input type="text" class="form-control" id="hubungan_wali" name="hubungan_wali">
									</div>
								</div>
							</div>
						</div>

					</div>

					<div class="panel-heading clearfix">
						<div class="pull-right">
							<a href="{{route('admin.index')}}" class="btn btn-default">BATAL</a>
							<button class="btn btn-primary">SIMPAN</button>
						</div>
					</div>

				</div>
			</form>
		</div>
	</div>
@endsection