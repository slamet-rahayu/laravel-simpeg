<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bagian;
use App\Jabatan;
use Auth;

class bagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ar_bagian = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->leftjoin('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->select('idbagian','nama_jabatan','nama_bagian','nama_pegawai',DB::raw('count(*) as total'))
        ->groupBy('nama_bagian')
        ->orderBy('nama_bagian','ASC')
        ->get();
        return view ('simpeg.bagian.index', compact('ar_bagian'));
    }

    /**
     * Search Data On Index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request) {

        $cari = $request->cari;
        $ar_bagian = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->leftjoin('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->select('idjabatan','idbagian','nama_jabatan','nama_bagian','nama_pegawai',DB::raw('count(*) as total'))
        ->groupBy('nama_bagian')
        ->where('nama_bagian','like','%'.$cari.'%')
        ->orwhere('idjabatan','=',$cari)
        ->paginate();
        return view ('simpeg.bagian.index', compact('ar_bagian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan = DB::table('jabatan')->select('*')->get();
        if (Auth::user()->role == 'admin') {
            return view('simpeg.bagian.create', compact('jabatan'));
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
            'jabatan_idjabatan' =>'required',
            'nama_bagian'       =>'required',
        ],[
            'jabatan_idjabatan.required' =>'Jabatan wajib diisi',
            'nama_bagian.required'       =>'Nama Bagian wajib diisi',
        ]);
        //
         //Input data Jabatan Baru
         DB::table('bagian')->insert(
            [
                'idbagian'   =>'A'
                    .substr($request->jabatan_idjabatan,0,2)
                    .substr($request->nama_bagian,0,2)
                    .date('dmy')
                    .rand(10,1000),
                'jabatan_idjabatan'=>$request->jabatan_idjabatan,
                'nama_bagian'=>$request->nama_bagian,

            ]
        );

        return redirect('/bagian')->with('sukses','Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idbagian)
    {
        //
        // Ambil 1 baris data yang mau di edit
        $data = bagian::where('idbagian' ,$idbagian)->get();

        return view('simpeg/bagian/edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idbagian)
    {
        $request->validate([
            'jabatan_idjabatan' =>'required',
            'nama_bagian'       =>'required',
        ],[
            'jabatan_idjabatan.required' =>'ID Bagian wajib diisi',
            'nama_bagian.required'       =>'Nama Bagian wajib diisi',
        ]);
        //
        DB::table('bagian')->where('idbagian','=',$idbagian)->update(
            [
                'jabatan_idjabatan'=>$request->jabatan_idjabatan,
                'nama_bagian'=>$request->nama_bagian

            ]
        );

        return redirect('/bagian')->with('edit','Data Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idbagian)
    {
        //
                //Hapus 1 baris data pada tabel
                DB::table('bagian')->where('idbagian', '=', $idbagian)->delete();

                return redirect('/bagian')->with('hapus','');
    }
}
