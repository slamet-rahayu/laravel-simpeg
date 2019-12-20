@extends('simpeg.index')
@section('main')

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
@foreach ($ar_pendidikan as $p)
<form role="form" method="POST" action="{{route('pendidikan.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-12">
	<div class="form-group">
		<label >
			Nama Pegawai
        </label>
    <input type="hidden" name="pegawai_idpegawai" value="{{$p->idpegawai}}" id="">
		<select name="" id="" class="form-control" disabled>
			<option value="{{$p->idpegawai}}">{{$p->nama_pegawai}}</option>
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
@endforeach
@endsection