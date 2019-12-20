@extends('simpeg.index')
@section('main')
@php
	$jbt = App\Jabatan::all();
	$bgn = App\Bagian::all();
@endphp

<a href="{{url('pegawai')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2>Form Pegawai</h2>
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

<form role="form" method="POST" action="{{route('pegawai.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-6">
	<div class="form-group">
		<label for="bagian_idbagian">
			Bagian
		</label>
		<select name="bagian_idbagian" id="" class="form-control">
		<option value="">--------</option>
			@foreach ($bgn as $b)
			@php
			$old = (old('bagian_idbagian') == $b['idbagian']) ? 'selected' : '';
			@endphp
		<option value="{{$b->idbagian}}" {{$old}}>{{$b->nama_bagian}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Nama Pegawai
		</label>
		<input type="text" class="form-control" name="nama_pegawai" value="{{ old('nama_pegawai') }}" />
	</div>
	<div class="form-group">
		<label>
			Jenis Kelamin
		</label>
		<select name="jen_kel" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($jk as $j)
			@php
			$old = (old('jen_kel') == $j['jn_kel']) ? 'selected' : '';
			@endphp
			<option value="{{$j['jn_kel']}}" {{$old}}>{{$j['jn_kel']}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Alamat
		</label>
		<input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" />
	</div>
	<div class="form-group">
		<label>
			Tempat Lahir
		</label>
		<input type="text" class="form-control" name="tmp_lahir"
		       value="{{ old('tmp_lahir') }}" />
	</div>
	<div class="form-group">
		<label>
			Tanggal Masuk
		</label>
		<input type="date" class="form-control" name="tgl_masuk"
			   value="{{ old('tgl_masuk') }}" id="datepicker" />
	</div>
		</div>
		<div class="col-lg-6">
	<div class="form-group">
		<label>
			Tanggal Lahir
		</label>
		<input type="date" class="form-control" name="tgl_lahir"
			   value="{{ old('tgl_lahir') }}" id="datepicker" />
	</div>
	<div class="form-group">
		<label>
			Status
		</label>
		<select name="status" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($stts as $st)
			@php
			$old = (old('status') == $st['status']) ? 'selected' : '';
			@endphp
			<option value="{{$st['status']}}" {{$old}}>{{$st['status']}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Agama
		</label>
		<select name="agama" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($agm as $ag)
			@php
			$old = (old('agama') == $ag['agama']) ? 'selected' : '';
			@endphp
			<option value="{{$ag['agama']}}" {{$old}}>{{$ag['agama']}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Email
		</label>
		<input type="text" class="form-control" name="email"
			   value="{{ old('email') }}" />
	</div>
	<div class="form-group">
		<label>
			No Hp
		</label>
		<input type="text" class="form-control" name="no_hp" maxlength="13"
			   value="{{ old('no_hp') }}" />
	</div>
	<div class="form-group">
			<label>
				Status Pegawai
			</label>
			<select name="status_pegawai" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($sttsp as $sts)
			@php
			$old = (old('status_pegawai') == $sts['stts_pgw']) ? 'selected' : '';
			@endphp
			<option value="{{$sts['stts_pgw']}}" {{$old}}>{{$sts['stts_pgw']}}</option>
			@endforeach
			</select>
	</div>
	
		</div>
	<div class="col-lg-6">
		{{-- <div class="form-group">
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
		</div> --}}
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
	<div class="col-lg-6">
		{{-- <div class="form-group">
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
		</div> --}}
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
			<div class="form-group">
				<label>Upload Foto</label>
				   <input type="file" name="foto" class="file-upload-default">
				   <div class="input-group">
						 <input type="text" class="form-control file-upload-info" disabled placeholder="File didukung: *.jpg, *.png, *.jpeg, (Maks 2MB)">
						 <span class="input-group-append">
						   <button class="file-upload-browse btn btn-inverse-primary" type="button">Upload</button>
						 </span>
					   </div>
			   </div>
	</div>
	</div>

	
		<button type="submit" class="btn btn-md btn-inverse-primary">Kirim</button>		
		<button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
</form>
{{-- <br>
<button type="button" name="tmbh-col" class="btn btn-sm btn-inverse-primary"><i class="ti-plus"></i>Tambah Kolom</button>
<br> --}}
@endsection