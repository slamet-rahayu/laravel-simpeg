@extends('simpeg.index')
@section('main')
@php
	$peg = App\Pegawai::orderBy('nama_pegawai')->get();
@endphp

<a href="{{url('pendidikan')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2>Tambah Data Pendidikan</h2>
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

<form role="form" method="POST" action="{{route('pendidikan.store')}}" enctype="multipart/form-data">
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
		<label>
			Pendidikan
		</label>
		<select name="pendidikan" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($pend as $p)
			@php
			$old = (old('pendidikan') == $p['pend']) ? 'selected' : '';
			@endphp
			<option value="{{$p['pend']}}" {{$old}}>{{$p['pend']}}</option>	
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Nama Instansi
		</label>
		<input type="text" class="form-control" name="instansi"
		       value="{{ old('instansi') }}" />
	</div>
	<div class="form-group">
		<label>
			Tahun Lulus
		</label>
		<input type="date" class="form-control" name="tahun_lulus"
		       value="{{ old('tahun_lulus') }}" />
	</div>
	<div class="form-group">
		<label>
			Gelar
		</label>
		<input type="text" class="form-control" name="gelar"
		       value="{{ old('gelar') }}" />
	</div>
	
		</div>
	</div>
		<button type="submit" class="btn btn-md btn-inverse-primary">Kirim</button>		
		<button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
</form>
<br>
@endsection