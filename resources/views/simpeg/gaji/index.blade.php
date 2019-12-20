@extends('simpeg.index')
@section('main')

<h2><b><center>Data Gaji</center></b></h2>

<div class="row">
	<div class="col-md-3">
	{{-- @if (Auth::user()->role == 'admin')
	<a href="{{route('gaji.create')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-plus">&nbsp;Tambah Data Gaji</i></a>
	@endif --}}
	</div>
	<div class="col-md-9">
		<form action="{{route('gaji.cari')}}">
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

@foreach ($ar_gaji as $g)
<div class="accordion" id="accordionExample">
		<div class="card">
		  <div class="card-header" id="{{$g->nama_pegawai}}" style="padding: 0px; background-color: #dddce1;">
			<h2 class="mb-0">
			  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$g->idgaji}}" aria-expanded="" aria-controls="{{$g->idgaji}}" style="color: black; text-decoration: none;">
				<b>{{$g->nama_pegawai}}</b>
			  </button>
			</h2>
		  </div>
		  @if (Auth::user()->role == 'admin')
		  <div id="{{$g->idgaji}}" class="collapse" aria-labelledby="{{$g->nama_pegawai}}" data-parent="#accordionExample">	  
		  @else
		  <div id="{{$g->idgaji}}" class="collapse show" aria-labelledby="{{$g->nama_pegawai}}" data-parent="#accordionExample">	  
		  @endif
			<div class="card-body">
				<div class="row">
				 <div class="col-lg-9">
			 <table class="table table-bordered table-hover">
				 <tr>
					<th>NIP</th>
					<td>{{$g->idpegawai}}</td>
				</tr>
				<tr>
					<th>Nama Pegawai</th>
					<td>{{$g->nama_pegawai}}</td>
				</tr>
				<tr>
					<th>Gaji Pokok</th>
					<td>Rp.&nbsp;{{number_format($g->gaji_pokok,2,',','.')}}</td>
				</tr>
				<tr>
					<th>Tunjangan Jabatan</th>
					@if (!empty($g->tunjab))
					<td>Rp.&nbsp;{{number_format($g->tunjab,2,',','.')}}</td>
					@else
					<td>Rp. - </td>
					@endif
				</tr>
				<tr>
					<th>Lain - Lain</th>
					@if (!empty($g->lain2))
					<td>Rp.&nbsp;{{number_format($g->lain2,2,',','.')}}</td>
					@else
					<td>Rp. - </td>
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
						@if (!empty($g->foto))
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images')}}/{{$g->foto}}"
							class="mx-auto d-block img-fluid"></th>
						@else
						<th colspan="2" class="bg-dark"><img style="width: 200px; height: 280px;" src="{{asset('images/person.jpg')}}"
							class="mx-auto d-block img-fluid"></th>	
						@endif
					</tbody>
					@if (Auth::user()->role == 'admin')
					<tfoot>
						{{-- <td class="bg-dark">
							<form method="post" action="{{route('gaji.destroy',$g->idgaji)}}">
		    					@csrf
		    					@method('delete')
							<button type="submit" class="btn btn-inverse-danger btn-sm" onclick="JSalert()"><i class="ti-trash"></i>Hapus</button>
						</form>
						</td> --}}
						<td class="bg-dark"> 
							 <a href="{{route('gaji.edit', $g->idgaji)}}" class="btn btn-sm btn-inverse-info"> <i class="ti-pencil-alt"></i>Edit</a>
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