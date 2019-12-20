@extends('simpeg.index')
@section('main')

<h2><b><center>Data Pendidikan</center></b></h2>

<div class="row">
	<div class="col-md-3">
	{{-- @if (Auth::user()->role == 'admin')
	<a href="{{route('pendidikan.create')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-plus">&nbsp;Tambah Data Pendidikan</i></a>
	@else
		
	@endif --}}
	</div>
	<div class="col-md-9">
		<form action="{{route('pendidikan.cari')}}">
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
<br/>
@foreach ($ar_pendidikan as $p)
<div class="accordion" id="accordionExample">
		<div class="card">
		  <div class="card-header" id="{{$p->nama_pegawai}}" style="padding: 0px; background-color: #dddce1;">
			<h2 class="mb-0">
			  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$p->idpendidikan}}" aria-expanded="" aria-controls="{{$p->idpendidikan}}" style="color: black; text-decoration: none;">
				<b>{{$p->nama_pegawai}}</b>
			  </button>
			</h2>
		  </div>
	  
		  <div id="{{$p->idpendidikan}}" class="collapse" aria-labelledby="{{$p->nama_pegawai}}" data-parent="#accordionExample">
			<div class="card-body">
				<div class="row">
				 <div class="col-lg-9">
			 <table class="table table-bordered table-hover">
				 <tr>
					<th>NIP</th>
					<td>{{$p->idpegawai}}</td>
				</tr>
				<tr>
					<th>Nama Pegawai</th>
					<td>{{$p->nama_pegawai}}</td>
				</tr>
				<tr>
					<th>Pendidikan</th>
					<td>{{$p->pendidikan}}</td>
				</tr>
				<tr>
					<th>Nama Instansi</th>
					<td>{{$p->instansi}}</td>
				</tr>
				<tr>
					<th>Tahun Lulus</th>
					<td>{{date('d-F-Y',strtotime($p->tahun_lulus))}}</td>
				</tr>
				<tr>
					<th>Gelar</th>
					@if (!empty($p->gelar))
					<td>{{$p->gelar}}</td>
					@else
					<td>-</td>
					@endif
				</tr>

			 </table>
			  </div>
			  <div class="col-lg-3 justify-content-center">
				<table class="table table-responsive">
					<thead>
						<th colspan="2" class="table-dark">Foto</th>
					</thead>
					<tbody>
						@if (!empty($p->foto))
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images')}}/{{$p->foto}}"
							class="img-fluid mx-auto d-block"></th>
						@else
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images/person.jpg')}}"
							class="img-fluid mx-auto d-block"></th>	
						@endif
					</tbody>
					@if (Auth::user()->role == 'admin')
					<tfoot>
						{{-- <td class="bg-dark">
							<form method="post" action="{{route('pendidikan.destroy',$p->idpendidikan)}}">
		    					@csrf
		    					@method('delete')
							<button type="submit" class="btn btn-inverse-danger btn-sm" onclick="JSalert()"><i class="ti-trash"></i>Hapus</button>
						</form>
						</td> --}}
						<td class="bg-dark"> 
							 <a href="{{route('pendidikan.edit', $p->pegawai_idpegawai)}}" class="btn btn-sm btn-inverse-info"> <i class="ti-pencil-alt"></i>Edit</a>
						</td>
					</tfoot>
					@endif
				</table>
			  </div>
			 </div>
			</div>
		  </div>
		</div>
	  </div>
	  @endforeach

@endsection 