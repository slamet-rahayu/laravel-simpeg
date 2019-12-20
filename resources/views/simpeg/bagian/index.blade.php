@extends('simpeg.index')
@section('main')
@php
  Use App\Bagian;
  Use App\Jabatan;
@endphp

<h2><b><center>Data Bagian</center></b></h2>

<div class="row">
	<div class="col-md-3">
	@if (Auth::user()->role == 'admin')
	<a href="{{route('bagian.create')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-plus">&nbsp;Tambah Data bagian</i></a>	
	@endif
	<br><br>
	</div>
	<div class="col-md-9">
			<form action="{{route('bagian.cari')}}">
			<div class="form-group" style="margin-left: 70%;">
				<div class="input-group">
				<input type="text" class="form-control" name="cari" value="{{old('cari')}}" placeholder="Cari . . ." aria-label="Recipient's username">
				  <div class="input-group-append">
					<button class="btn btn-sm btn-inverse-primary" type="submit"><i class="ti-search"></i> Cari</button>
				  </div>
				</div>
			  </div>
			</form>
			</div>
</div>

@foreach ($ar_bagian as $bag)
<div class="accordion" id="accordionExample">
		<div class="card">
		  <div class="card-header" id="{{$bag->nama_bagian}}" style="padding: 0px; background-color: #dddce1;">
			<h2 class="mb-0">
			  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$bag->idbagian}}" aria-expanded="true" aria-controls="pbpm006" style="color: black; text-decoration: none;">
				<b>{{$bag->nama_bagian}}</b>
			  </button>
			</h2>
		  </div>
	  
		  <div id="{{$bag->idbagian}}" class="collapse" aria-labelledby="{{$bag->nama_bagian}}" data-parent="#accordionExample" style="">
			<div class="card-body">
				<div class="row">
				 <div class="col-lg-9">
			 <table class="table table-bordered table-hover">
				 <tbody>
				<tr>
					{{-- <th>ID Bagian</th> --}}
					<th>Jabatan</th>
					<th>Bagian</th>
					<th colspan="2">Total Pegawai</th>
					@if (Auth::user()->role == 'admin')
					<th colspan="2"><center>Action</center></th>
					@endif
				</tr>
				<tr>
					{{-- <td>{{$bag->idbagian}}</td> --}}
					<td>{{$bag->nama_jabatan}}</td>
					<td>{{$bag->nama_bagian}}</td>
					@if ($bag->nama_pegawai == '')
					<td>0</td>
					<td><a href="{{url('/pegawai/cari?cari='.$bag->idbagian)}}">&nbsp;Lihat Pegawai Terkait>>></a></td>
					@else
					<td>({{$bag->total}})</td>
					<td><a href="{{url('/pegawai/cari?cari='.$bag->idbagian)}}">&nbsp;Lihat Pegawai Terkait>>></a></td>
					@endif
					@if (Auth::user()->role == 'admin')				
					<td><center>
					<a class="btn btn-md btn-inverse-primary" href="{{ route('bagian.edit',$bag->idbagian) }}">Edit</a>
					</center></td>
					<td><center>
						<form action="{{ route('bagian.destroy',$bag->idbagian )}}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-md btn-inverse-danger" onclick="JSalert()">Hapus</button>
						</form>
					</center></td>
					@endif
				</tr>
			 </tbody>
			</table>
			  </div>

			  
			 </div>
			</div>
		  </div>
		</div>
	  </div>	

@endforeach      
@endsection
