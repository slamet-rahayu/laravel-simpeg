@extends('simpeg.index')
@section('main')
@php
	$peg = App\Pegawai::all();
@endphp

<a href="{{url('gaji')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2><b>Edit Gaji Pegawai</b></h2>
@if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
<br>
@foreach ($ar_gaji as $g)
<form role="form" method="POST" action="{{route('gaji.update',$g->idgaji)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
	<div class="row">
		<div class="col-lg-12">
	<div class="form-group">
		<label >
			Nama Pegawai
		</label>
		<input type="text" name="pegawai_idpegawai" class="form-control" value="{{$g->nama_pegawai}}" disabled>
	</div>
	<div class="form-group">
		<label for="">Gaji Pokok</label>
	    <div class="input-group">
		 <div class="input-group-prepend">
			 <span class="input-group-text bg-primary text-white">Rp.</span>
		 </div>
		<input type="number" class="form-control" name="gaji_pokok"
			   value="{{$g->gaji_pokok}}" />
		<div class="input-group-append">
			<span class="input-group-text">,00</span>
		</div>
	 </div>
	</div>
	<div class="form-group">
		<label for="">Tunjangan Jabatan</label>
	 <div class="input-group">
		 <div class="input-group-prepend">
			 <span class="input-group-text bg-primary text-white">Rp.</span>
		 </div>
		<input type="number" class="form-control" name="tunjab"
			   value="{{$g->tunjab}}" />
		<div class="input-group-append">
			<span class="input-group-text">,00</span>
		</div>
	 </div>
	</div>
	<div class="form-group">
		<label for="">Lain - lain</label>
	 <div class="input-group">
		 <div class="input-group-prepend">
		<span class="input-group-text bg-primary text-white">Rp.</span>
		 </div>
		<input type="number" class="form-control" name="lain2"
			   value="{{$g->lain2}}" />
		<div class="input-group-append">
			<span class="input-group-text">,00</span>
		</div>
	 </div>
	</div>
	
		</div>
	</div>
		<button type="submit" class="btn btn-md btn-inverse-primary">Perbarui</button>				   
</form>
<br>
@endforeach
@endsection