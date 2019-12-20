@extends('simpeg.index')
@section('main')

<h2><b><center>Data Jabatan</center></b></h2>

<div class="row">
	<div class="col-md-3">
	@if (Auth::user()->role == 'admin')
	<a href="{{route('jabatan.create')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-plus">&nbsp;Tambah Data Jabatan</i></a>
	@endif
	<br><br>
	</div>
	<div class="col-md-9">
		<form action="{{route('jabatan.cari')}}">
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
@foreach ($ar_jabatan as $jab)
<div class="accordion" id="accordionExample">
		<div class="card">
		  <div class="card-header" id="{{$jab->nama_jabatan}}" style="padding: 0px; background-color: #dddce1;">
			<h2 class="mb-0">
			  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$jab->idjabatan}}" aria-expanded="true" aria-controls="pbpm006" style="color: black; text-decoration: none;">
				<b>{{$jab->nama_jabatan}}</b>
			  </button>
			</h2>
		  </div>
	  
		  <div id="{{$jab->idjabatan}}" class="collapse" aria-labelledby="{{$jab->nama_jabatan}}" data-parent="#accordionExample" style="">
			<div class="card-body">
				<div class="row">
				 <div class="col-lg-3">
			 <table class="table table-bordered table-hover">
				 <tbody><tr>
					{{-- <th>ID</th> --}}
					<th>Nama Jabatan</th>
					<th colspan="2">Jumlah Bagian</th>
					@if (Auth::user()->role == 'admin')
					<th colspan="2"><center>Action</center></th>
					@endif
				</tr>
				
				<tr>
					{{-- <td>{{$jab->idjabatan}}</td> --}}
					<td>{{$jab->nama_jabatan}}</td>
					@if ($jab->nama_bagian == '')
					<td>0</td>
					<td><a href="{{url('/pegawai/cari?cari='.$jab->idbagian)}}">&nbsp;Lihat Pegawai Terkait>>></a></td>
					@else
					<td>({{$jab->total}})</td>
					<td><a href="{{url('bagian/cari?cari='.$jab->idjabatan)}}">Lihat Bagian Terkait>>></a></td>
					@endif
					@if (Auth::user()->role == 'admin')
					<td><center><a class="btn btn-md btn-inverse-primary" href="{{ route('jabatan.edit',$jab->idjabatan) }}">
							Edit
						</a>
					</center></td>				
					<td><center>
				<form action="{{ route('jabatan.destroy',$jab->idjabatan )}}" method="POST"> 
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-md btn-inverse-danger" onclick="JSalert()">
							Hapus
							</button>
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