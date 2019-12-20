@extends('simpeg.index')
@section('main')
@php
	$peg = App\Pegawai::all();
@endphp

<a href="{{url('pendidikan')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>
<br><br>
<h2>Edit Data Pendidikan</h2>
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

@foreach ($ar_pendidikan as $ap)
<form role="form" method="POST" action="{{route('pendidikan.update', $ap->idpendidikan)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
	<div class="row">
		<div class="col-lg-12">
    <div class="form-group">
		    <label>
			    Nama Pegawai
		    </label>
		<input type="text" class="form-control" name="pegawai_idpegawai" value="{{$ap->nama_pegawai}}" disabled />
        </div>
        <div class="form-group">
            <label>
                Pendidikan
            </label>
            <select name="pendidikan" id="" class="form-control">
                <option value="">---------</option>
                @foreach ($pend as $p)
                @php
                $sel = ($ap->pendidikan == $p['pend']) ? 'selected' : '';    
                @endphp
                <option value="{{$p['pend']}}"  {{$sel}}>{{$p['pend']}}</option>    
                @endforeach
            </select>
        </div>
	    <div class="form-group">
		    <label>
			    Nama Instansi
		    </label>
		<input type="text" class="form-control" name="instansi" value="{{$ap->instansi}}" />
        </div>
        <div class="form-group">
                <label>
                    Tahun Lulus
                </label>
           <input type="date" class="form-control" name="tahun_lulus" value="{{$ap->tahun_lulus}}" />
        </div>
        <div class="form-group">
                <label>
                    Gelar
                </label>
        <input type="text" class="form-control" name="gelar" value="{{$ap->gelar}}" />
        </div>
	</div>
</div>
		<button type="submit" class="btn btn-md btn-inverse-primary">Kirim</button>		
		<button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
</form>
@endforeach
@endsection

