@php
    $no=1;
@endphp
<html>
<head>
    <title>Data Pegawai</title>
</head>
<body>
    <h1 align="center">Data Pegawai</h1>
    <table border=1 cellspacing=0 cellpadding=0>
        <tr>
            <td>No</td>
            <td>NIP</td>
            <td>Nama Pegawai</td>
            <td>Jabatan</td>
            <td>Bagian</td>
            <td>Jenis Kelamin</td>
            <td>Alamat</td>
            <td>Tempat Lahir</td>
            <td>Tanggal Lahir</td>
            <td>Status</td>
            <td>Agama</td>
            <td>E-mail</td>
            <td>No Hp</td>
            <td>Tanggal Masuk</td>
            <td>Status Pegawai</td>
            <td>Foto</td>

        </tr>
        @foreach ($pegawai as $p)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$p->idpegawai}}</td>
            <td>{{$p->nama_pegawai}}</td>
            <td>{{$p->nama_jabatan}}</td>
            <td>{{$p->nama_bagian}}</td>
            <td>{{$p->pendidiakn}}</td>
            <td>{{$p->jen_kel}}</td>
            <td>{{$p->alamat}}</td>
            <td>{{$p->tmp_lahir}}</td>
            <td>{{$p->tgl_lahir}}</td>
            <td>{{$p->status}}</td>
            <td>{{$p->agama}}</td>
            <td>{{$p->email}}</td>
            <td>{{$p->no_hp}}</td>
            <td>{{$p->tgl_masuk}}</td>
            <td>{{$p->status_pegawai}}</td>
            @if (!empty($p->foto))
            <td><img src="{{asset('images')}}/{{$p->foto}}" style="border-radius:100%; width:40px; height:40px;"></td>    
            @else
            <td><img src="{{asset('images/person.png')}}" style="border-radius:100%; width:40px; height:40px;"></td>    
            @endif  
        </tr>
        @endforeach
        <tr>
        <td colspan="16">Total Pegawai : {{count($pegawai)}}</td>
        </tr>
    </table>
</body>
</html>