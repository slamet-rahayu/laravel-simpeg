@extends('simpeg.index')
@section('main')
@php
	$jbt = App\Jabatan::all();
    $bgn = App\Bagian::all();
    $pgw = App\Pegawai::all();
@endphp

<a href="{{url('pegawai')}}" class="btn btn-sm btn-inverse-primary"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2>Edit Pegawai</h2>
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
@foreach ($pegawai as $s)
<form role="form" method="POST" action="{{route('pegawai.update', $s->idpegawai)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                $sel = ($s->bagian_idbagian == $b->idbagian) ? 'selected' : '';
            @endphp
		<option value="{{$b->idbagian}}" {{$sel}}>{{$b->nama_bagian}}</option>
			@endforeach
		</select>
	</div>
	{{-- <div class="form-group">
		<label>
			NIP
		</label>
		<input type="text" class="form-control" name="idpegawai" value="{{$s->idpegawai}}" />
	</div> --}}
	<div class="form-group">
		<label>
			Nama Pegawai
		</label>
		<input type="text" class="form-control" name="nama_pegawai" value="{{$s->nama_pegawai}}" />
	</div>
	<div class="form-group">
		<label>
			Jenis Kelamin
		</label>
		<select name="jen_kel" id="" class="form-control">
			<option value="">--------</option>
			@foreach ($jk as $j)
			@php
			$sel = ($s->jen_kel == $j['jn_kel']) ? 'selected' : '';
			@endphp
			<option value="{{$j['jn_kel']}}" {{$sel}}>{{$j['jn_kel']}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Alamat
		</label>
		<input type="text" class="form-control" name="alamat" value="{{$s->alamat}}" />
	</div>
	<div class="form-group">
		<label>
			Tempat Lahir
		</label>
		<input type="text" class="form-control" name="tmp_lahir" value="{{$s->tmp_lahir}}" />
	</div>
	<div class="form-group">
		<label>
			Tanggal Masuk
		</label>
		<input type="date" class="form-control" name="tgl_masuk" value="{{$s->tgl_masuk}}" />
	</div>
		</div>
		<div class="col-lg-6">
	<div class="form-group">
		<label>
			Tanggal Lahir
		</label>
		<input type="date" class="form-control" name="tgl_lahir" value="{{$s->tgl_lahir}}" />
	</div>
	<div class="form-group">
		<label>
			Status
		</label>
		<select name="status" id="" class="form-control">
            <option value="">--------</option>
			@foreach ($stts as $st)
			@php
			$sel = ($s->status == $st['status']) ? 'selected' : '';
			@endphp
			<option value="{{$st['status']}}" {{$sel}}>{{$st['status']}}</option>
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
			$sel = ($s->agama == $ag['agama']) ? 'selected' : '';
			@endphp
			<option value="{{$ag['agama']}}" {{$sel}}>{{$ag['agama']}}</option>
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label>
			Email
		</label>
        <input type="text" class="form-control" name="email" value="{{$s->email}}" />
	</div>
	<div class="form-group">
		<label>
			No Hp
		</label>
		<input type="text" class="form-control" name="no_hp" value="{{$s->no_hp}}" />
	</div>
	<div class="form-group">
			<label>
				Status Pegawai
			</label>
			<select name="status_pegawai" id="" class="form-control">
                <option value="">--------</option>
				@foreach ($sttsp as $sts)
				@php
				$sel = ($s->status_pegawai == $sts['stts_pgw']) ? 'selected' : '';
				@endphp
				<option value="{{$sts['stts_pgw']}}" {{$sel}}>{{$sts['stts_pgw']}}</option>
				@endforeach
			</select>
	</div>
	
		</div>
		<div class="col-lg-12">
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

		<button type="submit" class="btn btn-md btn-inverse-primary">Perbarui</button>		
		<button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
</form>
{{-- <br>
<button type="button" name="tmbh-col" class="btn btn-sm btn-inverse-primary"><i class="ti-plus"></i>Tambah Kolom</button>
<br> --}}
@endforeach
@endsection