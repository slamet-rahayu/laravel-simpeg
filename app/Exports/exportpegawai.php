<?php

namespace App\Exports;

use App\Pegawai;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exportpegawai implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return 
        DB::table('jabatan')
        ->join('bagian','idjabatan','=','jabatan_idjabatan')
        ->join('pegawai','idbagian','=','bagian_idbagian')
        ->join('pend_terakhir','pegawai.idpegawai','=','pend_terakhir.pegawai_idpegawai')
        ->select('nama_jabatan',
                 'nama_bagian',
                 'pendidikan',
                 'idpegawai',
                 'nama_pegawai',
                 'jen_kel',
                 'alamat',
                 'tmp_lahir',
                 'tgl_lahir',
                 'status',
                 'agama',
                 'email',
                 'no_hp',
                 'tgl_masuk',
                 'status_pegawai')
        ->get();
    }

    public function headings(): array {
        return [
            'Jabatan',
            'Bagian',
            'Pendidikan',
            'NIP',
            'Nama Pegawai',
            'Jenis Kelamin',
            'Alamat',
            'Tempat Lahir',
            'Tanggal lahir',
            'Status',
            'Agama',
            'E-mail',
            'No. HP',
            'Tanggal Masuk',
            'Status Pegawai',
        ];
    }
}
