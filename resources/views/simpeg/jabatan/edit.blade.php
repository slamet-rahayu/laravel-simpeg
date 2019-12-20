@extends('simpeg.index')
{{-- @extends('simpeg.Jabatan.index') --}}
@section('main')
@php
  Use App\Jabatan;
  Use App\Bagian;
@endphp
  <a href="{{url('/jabatan')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
    </ul>
  </div><br />
@endif

          <br><br>
          <h2>Edit Jabatan</h2>
          <br>
          @foreach ($data_jabatan as $j)
          <form role="form" method="POST" action="{{ route('jabatan.update', $j->idjabatan)}}"  enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="row">
              <div class="col-lg-12">
            {{-- <div class="form-group">
              <label>
                ID Jabatan
              </label>
              <input type="text" class="form-control" name="idjabatan" value="{{ $j->idjabatan }}">
            </div> --}}
            <div class="form-group">
              <label>
                Nama jabatan
              </label>
              <input type="text" class="form-control" name="nama_jabatan" value="{{ $j->nama_jabatan }}" >
            </div>
            
              </div>
            </div>
              <button type="submit" class="btn btn-md btn-inverse-primary">Perbarui</button>				   
          </form>
@endforeach
@endsection
