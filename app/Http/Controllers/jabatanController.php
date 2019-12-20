<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Jabatan;
use APP\Bagian;
use Auth;

class jabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $ar_tot = DB::table('jabatan')
        // ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        
        // ->groupBy('nama_jabatan')
        // ->get();
        
        //menampilkan data jabatan
        $ar_jabatan = DB::table('jabatan')
        ->leftjoin('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->select('nama_jabatan','idjabatan','idbagian','nama_bagian',DB::raw('count(*) as total'))
        ->groupBy('nama_jabatan')
        ->get();
        return view ('simpeg.jabatan.index', compact('ar_jabatan'));
    }

    /**
     * Search Data On Index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request) {

        $cari = $request->cari;
        $ar_jabatan = DB::table('jabatan')
        ->leftjoin('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->select('nama_jabatan','idjabatan','idbagian','nama_bagian',DB::raw('count(*) as total'))
        ->groupBy('nama_jabatan')
        ->where('nama_jabatan','like','%'.$cari.'%')
        ->paginate();
        return view('simpeg.jabatan.index',compact('ar_jabatan'));
        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Menampilkan form input Data 
        if (Auth::user()->role == 'admin') {
            return view('simpeg.jabatan.create');
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
            'nama_jabatan'  =>'required',
        ],[
            'nama_jabatan.required' =>'Nama jabatan wajib diisi',
        ]);
        //Input data Jabatan Baru
        DB::table('Jabatan')->insert(
            [
                'idjabatan'   =>'A'
                    .substr($request->nama_jabatan,0,2)
                    .date('dmy')
                    .rand(10,1000),
                'nama_jabatan'=>$request->nama_jabatan

            ]
        );

        return redirect('jabatan')->with('sukses','Data Berhasil Disimpan');

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
    public function edit($idjabatan)
    {
        //
         // Ambil 1 baris data yang mau di edit
         $data_jabatan = Jabatan::where('idjabatan' ,$idjabatan)->get();
         if (Auth::user()->role == 'admin') {
            return view('simpeg/jabatan/edit',compact('data_jabatan'));
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
    public function update(Request $request, $idjabatan)
    {
        $request->validate([
            'nama_jabatan'  =>'required'
        ],[
            'nama_jabatan.required' =>'Nama jabatan wajib diisi'
        ]);
        //
        DB::table('jabatan')->where('idjabatan', $idjabatan)->update([
            'nama_jabatan'=>$request->nama_jabatan,
        ]);

        return redirect('/jabatan')->with('edit','Data Berhasil Di Edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idjabatan)
    {
        //Hapus 1 baris data pada tabel
        DB::table('Jabatan')->where('idjabatan', '=', $idjabatan)->delete();

        return redirect('/jabatan')->with('hapus','');
    }
}
