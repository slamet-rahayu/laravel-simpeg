<?php

namespace App\Http\Controllers;

use DB;
use App\Gaji;
use Illuminate\Http\Request;
use Validator;
use Auth;

class gajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ar_gaji = DB::table('gaji')
        ->join('pegawai','pegawai.idpegawai','=','gaji.pegawai_idpegawai')
        ->orderBy('nama_pegawai')
        ->get();
        if (Auth::user()->role == 'admin') {
        return view ('simpeg.gaji.index', compact('ar_gaji'));
        } else {
        return view ('simpeg.partials.restrict');
        }
    }

    /**
     * Search Data On Index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request) {

        $cari = $request->cari;
        $ar_gaji = DB::table('gaji')
        ->join('pegawai','pegawai.idpegawai','=','gaji.pegawai_idpegawai')
        ->where('nama_pegawai','like','%'.$cari.'%')
        ->paginate();
        return view ('simpeg.gaji.index', compact('ar_gaji'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role == 'admin') {
            return view('simpeg.gaji.create');
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
        //Simpan Ke Database
        $request->validate([
            'pegawai_idpegawai'   =>'required|unique:gaji',
            'gaji_pokok'        =>'required',
            ],
            [   
            'pegawai_idpegawai.required'=>'Nama Pegawai Wajib Di Isi',
            'pegawai_idpegawai.unique'=>'Pegawai Sudah Terdaftar',
            'gaji_pokok.required'      =>'Total Gaji Pokok Wajib Di Isi',
            ]);

        $data = DB::table('gaji')->insert([
            'idgaji'            =>'A'
                .substr($request->pegawai_idpegawai,0,2)
                .date('dmy')
                .rand(10,1000),
            'pegawai_idpegawai' =>$request->pegawai_idpegawai,
            'gaji_pokok'        =>$request->gaji_pokok,
            'tunjab'            =>$request->tunjab,
            'lain2'             =>$request->lain2,]);
            return redirect('/gaji')->with('sukses','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ar_gaji = DB::table('gaji')
        ->join('pegawai','pegawai.idpegawai','=','gaji.pegawai_idpegawai')
        ->where('email','=',$id)
        ->orderBy('nama_pegawai')
        ->get();

        return view('simpeg.gaji.index',compact('ar_gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Menampilkan Form Edit
        $ar_gaji = DB::table('gaji')->where('idgaji',$id)
        ->join('pegawai','pegawai.idpegawai','=','gaji.pegawai_idpegawai')
        ->select('*')
        ->get();
        if (Auth::user()->role == 'admin') {
            return view ('simpeg.gaji.edit', compact('ar_gaji'));
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
            'gaji_pokok'        =>'required',],
            [   
            'gaji_pokok.required'      =>'Total Gaji Pokok Wajib Di Isi',
            ]);

        $data = DB::table('gaji')->where('idgaji','=',$id)->update([

            'gaji_pokok'        =>$request->gaji_pokok,
            'tunjab'            =>$request->tunjab,
            'lain2'             =>$request->lain2,]);
            return redirect('/gaji')->with('edit','Data Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('gaji')->where('idgaji',$id)->delete();
        return redirect('/gaji')->with('hapus','');
    }
}
