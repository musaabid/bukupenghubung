@extends('main')

@section('nav')
	@include('partials._nav')
@endsection

@section('content')

<script>
	window.bp = {!! json_encode([
		'deleteRoute' => route('pengumuman.bulkDestroy')
	]) !!};
</script>

<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<h1 class="panel-title pull-left">SEMUA PENGUMUMAN</h1>
		<div class="pull-right">
			<a href="{{route('pengumuman.create')}}" class="btn btn-primary">Tambah Pengumuman</a>
			@if(Auth::User()->level == 'admin')
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
		<table id="{{Auth::User()->level == 'admin' ? 'datatable_pengumuman' : 'datatable_pengumuman_guru'}}" class="table table-hover table-bordered">
			<thead>
				<tr>
					@if(Auth::User()->level == 'admin')
						<th class="text-center valign-middle"><input type="checkbox" id="togglecb"></th>
					@endif
					<th width="50%">Pengumuman</th>
					<th width="20%">Dibuat oleh</th>
					<th>Dibuat pada</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $data['announcements'] as $announcement )
					<tr>
						@if(Auth::User()->level == 'admin')
							<td class="text-center valign-middle"><input type="checkbox"  class="cbRow" value="{{ $announcement->id }}" name="id[]"></td>
						@endif
						<td data-search="{{$announcement->pengumuman}}">
							@if( ! empty($announcement->id_kelas) )
								<span class="label label-primary">Kelas {{$announcement->classroom->nama_kelas}}</span> 
							@endif
							{{ $announcement->pengumuman }}
						</td>
						<td data-search="{{$announcement->author->nama}}">{{$announcement->author->nama}}</td>
						<td data-order="{{$announcement->created_at}}">{{ Helper::humantime( $announcement->created_at ) }}</td>
						<td>
							<form style="display: inline;" class="deleteForm" action="{{route('pengumuman.destroy', $announcement->id)}}" method="POST">
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}
								<button type="submit" title="Hapus pengumuman" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection