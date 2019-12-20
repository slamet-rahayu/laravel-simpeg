<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Pendidikan;
use Illuminate\Http\Request;
use Validator;

class pendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_pendidikan = DB::table('pend_terakhir')
        ->join('pegawai','pend_terakhir.pegawai_idpegawai','=','pegawai.idpegawai')
        ->orderBy('nama_pegawai')
        ->get();
        return view ('simpeg.pendidikan.index', compact('ar_pendidikan'));
    }

    /**
     * Search Data On Index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request) {

        $cari = $request->cari;
        $ar_pendidikan = DB::table('pend_terakhir')
        ->join('pegawai','pend_terakhir.pegawai_idpegawai','=','pegawai.idpegawai')
        ->where('pendidikan','like','%'.$cari.'%')
        ->orwhere('instansi','like','%'.$cari.'%')
        ->orwhere('gelar','like','%'.$cari.'%')
        ->orwhere('nama_pegawai','like','%'.$cari.'%')
        ->paginate();
        return view ('simpeg.pendidikan.index', compact('ar_pendidikan'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pd1 = ['pend'=>'SD'];
        $pd2 = ['pend'=>'SMP'];
        $pd3 = ['pend'=>'SMA/K'];
        $pd4 = ['pend'=>'Diploma'];
        $pd5 = ['pend'=>'Sarjana'];
        $pd6 = ['pend'=>'Magister'];
        $pd7 = ['pend'=>'Doktor'];

        $pend = [$pd1,$pd2,$pd3,$pd4,$pd5,$pd6,$pd7];

        if (Auth::user()->role == 'admin') {
            return view('simpeg.pendidikan.create',compact('pend'));
        } else {
            return view ('simpeg.partials.restrict');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_idpegawai'         =>'required|unique:pend_terakhir',
            'pendidikan'                =>'required',
            'instansi'                  =>'required',
            'tahun_lulus'               =>'required',],
            [  
            'pegawai_idpegawai.required'=>'Mohon Pilih Nama Pegawai',
            'pegawai_idpegawai.unique'  =>'Pegawai Telah terregistrasi',
            'pendidikan.required'       =>'Mohon Pilih Pendidikan',
            'instansi.required'         =>'Nama Instansi Wajib Di Isi',
            'tahun_lulus.required'      =>'Tahun Kelulusan Wajib Di Isi',]);

        DB::table('pend_terakhir')->insert([
            'idpendidikan'      =>'A'
                .substr($request->pendidikan,0,2)
                .substr($request->pegawai_idpegawai,0,2)
                .date('dmy')
                .rand(10,1000),
            'pegawai_idpegawai' =>$request->pegawai_idpegawai,
            'pendidikan'        =>$request->pendidikan,
            'instansi'          =>$request->instansi,
            'tahun_lulus'       =>$request->tahun_lulus,
            'gelar'             =>$request->gelar,]);

        // DB::table('pend_terakhir')->insert([
        //     'idpendidikan'=>rand(1,1000),
        //     'pegawai_idpegawai'=>$request->pegawai_idpegawai,
        //     'pendidikan'=>$request->pendidikan,
        //     'instansi'=>$request->instansi,
        //     'tahun_lulus'=>$request->tahun_lulus,
        // ]);
            return redirect('/pendidikan')->with('sukses','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pd1 = ['pend'=>'SD'];
        $pd2 = ['pend'=>'SMP'];
        $pd3 = ['pend'=>'SMA/K'];
        $pd4 = ['pend'=>'Diploma'];
        $pd5 = ['pend'=>'Sarjana'];
        $pd6 = ['pend'=>'Magister'];
        $pd7 = ['pend'=>'Doktor'];

        $pend = [$pd1,$pd2,$pd3,$pd4,$pd5,$pd6,$pd7];

        $ar_pendidikan = DB::table('pegawai')
        ->leftjoin('pend_terakhir','pegawai.idpegawai','=','pend_terakhir.pegawai_idpegawai')
        ->where('idpegawai',$id)
        ->get(); 

        return view('simpeg.pendidikan.show',compact('pend','ar_pendidikan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pd1 = ['pend'=>'SD'];
        $pd2 = ['pend'=>'SMP'];
        $pd3 = ['pend'=>'SMA/K'];
        $pd4 = ['pend'=>'Diploma'];
        $pd5 = ['pend'=>'Sarjana'];
        $pd6 = ['pend'=>'Magister'];
        $pd7 = ['pend'=>'Doktor'];

        $pend = [$pd1,$pd2,$pd3,$pd4,$pd5,$pd6,$pd7];

        $ar_pendidikan = DB::table('pend_terakhir')
        ->leftjoin('pegawai','pend_terakhir.pegawai_idpegawai','=','pegawai.idpegawai')
        ->select('*')
        ->where('pegawai_idpegawai',$id)
        ->get();

        if (Auth::user()->role == 'admin') {
            return view('simpeg.pendidikan.edit', compact('ar_pendidikan','pend'));
        } else {
            return view ('simpeg.partials.restrict');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'pendidikan'                =>'required',
            'instansi'                  =>'required',
            'tahun_lulus'               =>'required',],
            [
            'pendidikan.required'       =>'Pendidikan Wajib Diisi',
            'instansi.required'         =>'Nama Instansi Pendidikan Wajib Di Isi',
            'tahun_lulus.required'      =>'Tahun Kelulusan Wajib Di Isi',]);


       DB::table('pend_terakhir')->where('idpendidikan', $id)->update([
        'pendidikan'    =>$request->pendidikan,
        'instansi'      =>$request->instansi,
        'tahun_lulus'   =>$request->tahun_lulus,
        'gelar'         =>$request->gelar,]);

        return redirect('/pendidikan')->with('edit','Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pend_terakhir')->where('idpendidikan',$id)->delete();
        return redirect('/pendidikan')->with('hapus','');
    }
}
