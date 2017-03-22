@extends('main', ['page_title' => $data['page_title']] )

@section('nav')
	@include('partials._nav')
@endsection

@section('content')

<script>
	window.bp = {!! json_encode([
		'deleteRoute' => route('admin.bulkDestroy')
	]) !!};
</script>

<div class="panel panel-default">
	<div class="panel-heading clearfix">
		<div class="pull-left">
			<div class="btn-group">
				<a href="{{route('admin.index')}}" class="btn {{ empty( Request::get('l') ) ? 'btn-primary' : 'btn-default' }}">Semua</a>
				<a href="{{route('admin.index')}}?l=guru" class="btn {{ Request::get('l') == 'guru' ? 'btn-primary' : 'btn-default' }}">Admin &amp; Guru</a>
				<a href="{{route('admin.index')}}?l=siswa" class="btn {{ Request::get('l') == 'siswa' ? 'btn-primary' : 'btn-default' }}">Siswa</a>
			</div>
		</div>
		<div class="pull-right">
			@if(Auth::User()->level == 'admin')
				<a href="{{route('admin.create')}}" class="btn btn-primary">Tambah User</a>
				<button id="bulkDelete" class="btn btn-danger">Hapus</button>
			@endif
		</div>
	</div>
	<div class="panel-body" id="data-body">
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
					<th width="30%">Nama</th>
					<th>No. Induk</th>
					<th>No. Telepon</th>
					<th>Level</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $data['users'] as $user )
					<tr data-id="{{$user->id}}">
						<td class="text-center valign-middle">
							@if(Auth::User()->level == 'admin')
								<input type="checkbox" class="cbRow" value="{{ $user->id }}" name="id[]">
							@else 
								{{$user->id}}
							@endif
						</td>
						<td data-search="{{ $user->nama }}"><a href="{{route('admin.edit', $user->id)}}" title="Edit user">{{ $user->nama }}</a></td>
						<td data-search="{{ $user->noinduk }}">{{ $user->noinduk }}</td>
						<td data-search="{{ $user->telepon_1 }} {{ $user->telepon_2 }}">{{ $user->telepon_1 }} {{ ! empty( $user->telepon_2) ? '/ ' . $user->telepon_2 : '' }}</td>
						<td data-order="{{ $user->level }}">{{ ucfirst( $user->level) }}</td>
						<td>
							@if(Auth::User()->level == 'admin')
								<a href="{{route('admin.edit', $user->id) }}" title="Edit user" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
								<form style="display: inline;" class="deleteForm" action="{{route('admin.destroy', $user->id)}}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									{{ csrf_field() }}
									<button type="submit" title="Hapus user" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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