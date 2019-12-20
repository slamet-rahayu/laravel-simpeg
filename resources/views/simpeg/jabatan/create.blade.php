@extends('simpeg.index')
@section('main')
    <a href="{{url('jabatan')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>

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
    <h2>Tambah Jabatan Baru</h2>
    <br>
    <form role="form" method="POST" action="{{route('jabatan.store')}}" enctype="multipart/form-data">
     @csrf
    <div class="row">
        <div class="col-lg-12">
      {{-- <div class="form-group">
        <label>
          ID Jabatan
        </label>
      <input type="text" class="form-control" name="idjabatan" value="{{old('idjabatan')}}">
      </div> --}}
      <div class="form-group">
        <label>
          Nama jabatan
        </label>
      <input type="text" class="form-control" name="nama_jabatan" value="{{old('nama_jabatan')}}">
      </div>
      
        </div>
      </div>
    
        <button type="submit" class="btn btn-md btn-inverse-primary">Tambah</button>		
        <button type="reset" class="btn btn-md btn-inverse-danger">Batal</button>		   
    </form>
@endsection