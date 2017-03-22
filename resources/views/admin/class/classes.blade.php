@extends('main')

@section('nav')
	@include('partials._nav')
@endsection

@section('content')

<script>
	window.bp = {!! json_encode([
		'deleteRoute' => route('kelas.bulkDestroy')
	]) !!};
</script>

<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h1 class="panel-title pull-left">SEMUA KELAS</h1>
		<div class="pull-right">
			@if(Auth::User()->level == 'admin')
				<a href="{{route('kelas.create')}}" class="btn btn-primary">Tambah Kelas</a>
				<button id="bulkDelete" class="btn btn-danger">Hapus</button>
			@endif
		</div>
	</div>
	<div class="panel-body">
		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has('alert-' . $msg))
				<div class="alert alert-dismissible alert-{{ $msg }}">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					{{ Session::get('alert-' . $msg) }}
				</div>
			@endif
		@endforeach
		<table id="datatable" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th class="text-center valign-middle">
						@if(Auth::User()->level == 'admin')
							<input type="checkbox" id="togglecb">
						@else
							#
						@endif
					</th>
					<th width="30%">Nama Kelas</th>
					<th width="30%">Wali Kelas</th>
					<th>Tahun Ajaran</th>
					<th>Jumlah Siswa</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $data['classrooms'] as $classroom )
					<tr>
						<td class="text-center valign-middle">
							@if(Auth::user()->level == 'admin')
								<input type="checkbox"  class="cbRow" value="{{ $classroom->id }}" name="id[]">
							@else
								{{$classroom->id}}
							@endif
						</td>
						<td data-search="{{$classroom->nama_kelas}}">
							<a href="{{route('kelas.show', $classroom->id)}}" title="Lihat kelas">
								{{ $classroom->tingkat == 'kecil' ? 'TK. Kecil' : 'TK. Besar' }} - {{ $classroom->nama_kelas }}
							</a>
						</td>
						<td data-search="{{ ! empty( $classroom->teacher ) ? $classroom->teacher->nama : '' }}">{{ ! empty( $classroom->teacher ) ? $classroom->teacher->nama : '' }}</td>
						<td data-order="{{ $classroom->tahun_ajaran }}">{{ Helper::tahun_ajaran( $classroom->tahun_ajaran ) }}</td>
						<td data-order="{{count($classroom->student)}}">{{count($classroom->students)}}</td>
						<td>
							@if(Auth::User()->level == 'admin')
								<a href="{{route('kelas.edit', $classroom->id)}}" title="Edit kelas" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<form style="display: inline;" class="deleteForm" action="{{route('kelas.destroy', $classroom->id)}}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									{{ csrf_field() }}
									<button type="submit" title="Hapus kelas" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
								</form>
							@else 
								-
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection