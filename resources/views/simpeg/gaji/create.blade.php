@extends('simpeg.index')
@section('main')
@php
	$peg = App\Pegawai::orderBy('nama_pegawai')->get();
@endphp

<a href="{{url('gaji')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2>Input Gaji Pegawai</h2>
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

<form role="form" method="POST" action="{{route('gaji.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-12">
	<div class="form-group">
		<label >
			Nama Pegawai
		</label>
		<select name="pegawai_idpegawai" id="" class="form-control">
		<option value="">--------</option>
			@foreach ($peg as $p)
			@php
			$old = (old('pegawai_idpegawai') == $p['idpegawai']) ? 'selected' : '';
			@endphp
		<option value="{{$p->idpegawai}}" {{$old}}>{{$p->nama_pegawai}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="">Gaji Pokok</label>
	 <div class="input-group">
		 <div class="input-group-prepend">
			 <span class="input-group-text bg-primary text-white">Rp.</span>
		 </div>
		<input type="number" class="form-control" name="gaji_pokok"
			   value="{{ old('gaji_pokok') }}" />
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
			   value="{{ old('tunjab') }}" />
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
			   value="{{ old('lain2') }}" />
		<div class="input-group-append">
			<span class="input-group-text">,00</span>
		</div>
	 </div>
	</div>
	</div>
	</div>

	
		<button type="submit" class="btn btn-md btn-inverse-primary">Kirim</button>		
		<button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
</form>
<br>
@endsection