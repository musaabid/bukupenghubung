@extends('main_sidebar')

@section('nav')
	@include('partials._nav')
@endsection

@section('sidebar')
	@include('partials._sidebar')
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Dashboard</div>
	<div class="panel-body">
		Laporan akan ditampilkan disini
		<ul>
			<li>Balasan topik yang belum dibaca</li>
			<li>Statistik jumlah balasan selama 1 bulan terakhir</li>
			<li>Statistik jumlah topik selama 1 bulan terakhir</li>
			<li>Topik paling banyak per siswa</li>
		</ul>
	</div>
</div>
@endsection