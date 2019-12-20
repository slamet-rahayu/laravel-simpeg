@extends('simpeg.index')
@section('main')

<h2><b><center>Data Pegawai</center></b></h2>

<div class="row">
	<div class="col-md">
	@if (Auth::user()->role == 'admin')
	<a href="{{route('pegawai.create')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-plus">&nbsp;Tambah Data Pegawai</i></a>
	<a href="{{route('pegawai.export')}}" class="btn btn-sm btn-inverse-primary"><i class="fas fa-file-excel"></i>&nbsp;Export Excel</a>
	<a href="{{route('pegawai.pdf')}}" class="btn btn-sm btn-inverse-primary"><i class="fas fa-file-pdf"></i>&nbsp;Export PDF</a>
	@endif
	</div>
	<div class="col-md">
	   <form action="{{route('pegawai.cari')}}">
		<div class="form-group" style="margin-left: 55%;">
			<div class="input-group">
			<input type="text" class="form-control" placeholder="Cari . . ." aria-label="Recipient's username" name="cari" value="{{old('cari')}}">
			  <div class="input-group-append">
				<button class="btn btn-sm btn-inverse-primary" type="submit"><i class="ti-search"></i> Cari</button>
			  </div>
			</div>
		  </div>
		</form>	
		</div>
</div>
<br>

@foreach ($pegawai as $s)
<div class="accordion" id="accordionExample">
		<div class="card">
		  <div class="card-header" id="{{$s->nama_pegawai}}" style="padding: 0px; background-color: #dddce1;">
			<h2 class="mb-0">
			  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{substr($s->email,0,3)}}" aria-expanded="" aria-controls="{{substr($s->email,0,3)}}" style="color: black; text-decoration: none;">
				<b>{{$s->nama_pegawai}}</b>
			  </button>
			</h2>
		  </div>
	  
		  <div id="{{substr($s->email,0,3)}}" class="collapse" aria-labelledby="{{$s->nama_pegawai}}" data-parent="#accordionExample">
			<div class="card-body">
				<div class="row">
				 <div class="col-lg-9">
			 <table class="table table-bordered table-hover">
				 <tr>
					<th>NIP</th>
					<td>{{$s->idpegawai}}
					</td>
				</tr>
				<tr>
					<th>Nama Pegawai</th>
				<td>{{$s->nama_pegawai}}</td>
				</tr>
				<tr>
					<th>Jabatan</th>
					<td>{{$s->nama_jabatan}}</td>
				</tr>
				<tr>
					<th>Bagian</th>
					<td>{{$s->nama_bagian}}</td>
				</tr>
				<tr>
					<th>Pendidikan</th>
					@if (!empty($s->pendidikan))
					<td>{{$s->pendidikan}}</td>	
					@else
					<td><a href="{{route('pendidikan.show',$s->idpegawai)}}">Tambah data pendidikan</a></td>	
					@endif
				</tr>
				<tr>
					<th>Jenis Kelamin</th>
					<td>{{$s->jen_kel}}</td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td>{{$s->alamat}}</td>
				</tr>
				<tr>
					<th>Tempat Lahir</th>
					<td>{{$s->tmp_lahir}}</td>					
				</tr>
				<tr>
					<th>Tanggal Lahir</th>
					<td>{{date('d-F-Y',strtotime($s->tgl_lahir))}}</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>{{$s->status}}</td>
				</tr>
				<tr>
					<th>Agama</th>
					<td>{{$s->agama}}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{$s->email}}</td>
				</tr>
				<tr>
					<th>No. Hp</th>
					<td>{{$s->no_hp}}</td>
				</tr>
				<tr>
					<th>Tanggal masuk</th>
					<td>{{date('d-F-Y',strtotime($s->tgl_masuk))}}</td>
				</tr>
				<tr>
					<th>Status pegawai</th>
					<td>{{$s->status_pegawai}}</td>
				</tr>
			 </table>
			  </div>
			  <div class="col-lg-3 justify-content-center">
				<table class="table table-responsive">
					<thead>
						<th colspan="2" class="table-dark">Foto</th>
					</thead>
					<tbody>
						@if (!empty($s->foto))
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images')}}/{{$s->foto}}"
							class="img-fluid"></th>
						@else
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images/person.png')}}"
							class="img-fluid d-block mx-auto"></th>	
						@endif
					</tbody>
					@if (Auth::user()->role == 'admin')
					<tfoot>
						<td class="bg-dark">
							<form method="post" action="{{route('pegawai.destroy',$s->idpegawai)}}">
		    					@csrf
		    					@method('delete')
							<button type="submit" class="btn btn-inverse-danger btn-sm" onclick="JSalert()"><i class="ti-trash"></i>Hapus</button>
						</form>
						</td>
						<td class="bg-dark"> 
							 <a href="{{route('pegawai.edit', $s->idpegawai)}}" class="btn btn-sm btn-inverse-info"> <i class="ti-pencil-alt"></i>Edit</a>
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