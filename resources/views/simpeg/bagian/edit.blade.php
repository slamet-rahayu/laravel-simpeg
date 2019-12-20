@extends('simpeg.index')
{{-- @extends('simpeg.bagian.index') --}}
@section('main')
@php
    $jab = App\Jabatan::all();
@endphp
<a href="{{url('bagian')}}" class="btn btn-sm btn-inverse-primary" onclick="yakin()"><i class="ti-arrow-circle-left"></i>&nbsp;Kembali</a><br>
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
    <h2>Edit Bagian</h2>
    <br>
             @foreach ($data as $b)
                <form method="POST" action="{{ route('bagian.update', $b->idbagian)}}">
                    @method('PUT')
                    @csrf
                        {{-- <div class="form-group">
                          <label for="exampleInputID1">ID Bagian</label>
                          <input type="text" class="form-control" name="idbagian" value="{{ $b->idbagian }}" id="exampleInputID1" aria-describedby="IDHelp" placeholder="Masukkan ID">
                        </div> --}}
                      
                        <div class="form-group">
                            <label>Nama Jabatan </label>
                            <select name="jabatan_idjabatan" id="" class="form-control">
                                    <option value="">------</option>
                                    @foreach ($jab as $j)
                                    @php
                                    $sel = ($b->jabatan_idjabatan == $j->idjabatan) ? 'selected' : '';
                                    @endphp
                                      <option value="{{$j->idjabatan}}" {{$sel}}>{{$j->nama_jabatan}}</option>
                                    @endforeach
                                     
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputtext1">Nama Bagian</label>
                                <input type="text" class="form-control" name="nama_bagian" value="{{ $b->nama_bagian }}" id="exampleInputtext1" placeholder="bagian">
                            </div>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
@endforeach
@endsection