@extends('simpeg.index')
@section('main')
          
    <a href="{{url('bagian')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a>

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
    <h2>Tambah Bagian Baru</h2>
    <br>
    <form role="form" method="POST" action="{{route('bagian.store')}}" enctype="multipart/form-data">
     @csrf
    <div class="row">
        <div class="col-lg-12">
      {{-- <div class="form-group">
        <label>
          ID Bagian
        </label>
      <input type="text" class="form-control" name="idbagian" value="{{old('idbagian')}}">
      </div> --}}
      <div class="form-group">
          <label for="exampleInputID1">Nama Jabatan </label>
          <select name="jabatan_idjabatan" id="" class="form-control">
                  <option value="">--Jabatan--</option>
                      @foreach ($jabatan as $jab)
                      @php
                          $old = (old('jabatan_idjabatan') == $jab->idjabatan) ? 'selected' : '';
                      @endphp
                      <option value="{{$jab->idjabatan}}" {{$old}}>{{$jab->nama_jabatan}}</option>
                      @endforeach
                  </select>
      </div>
      <div class="form-group">
        <label>
          Nama Bagian
        </label>
        <input type="text" class="form-control" name="nama_bagian" value="{{old('nama_bagian')}}">
      </div>
      
        </div>
      </div>
    
        <button type="submit" class="btn btn-md btn-inverse-primary">Tambah</button>		
        <button type="reset" class="btn btn-md btn-inverse-danger">Reset</button>		   
    </form>
    <br>
@endsection