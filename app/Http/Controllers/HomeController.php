<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Jabatan;
use App\Bagian;
use App\Pendidikan;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tot_pegawai = DB::table('pegawai')
        ->select(DB::raw('count(idpegawai) as total'))
        ->first();

        $tetap = DB::table('pegawai')
        ->select(DB::raw('count(idpegawai) as jumlah'))
        ->where('status_pegawai','=','tetap')
        ->first();

        $tdk_tetap = DB::table('pegawai')
        ->select(DB::raw('count(idpegawai) as jumlah'))
        ->where('status_pegawai','=','tidak tetap')
        ->first();

        $tot_jab = DB::table('jabatan')
        ->count();

        $tot_bag = DB::table('bagian')
        ->count();

        $tot_pend = DB::table('pend_terakhir')
        ->leftjoin('pegawai','pegawai_idpegawai','=','idpendidikan')
        ->select('pendidikan','idpendidikan','pegawai_idpegawai','nama_pegawai',DB::raw('count(*) as total'))
        ->get();
        
        $pl = DB::table('pegawai')
        ->where('jen_kel','=','laki-laki')
        ->count();

        $pp = DB::table('pegawai')
        ->where('jen_kel','=','perempuan')
        ->count();

        $smp = DB::table('pend_terakhir')
        ->where('pendidikan','=','SMP')
        ->count();

        $sma = DB::table('pend_terakhir')
        ->where('pendidikan','=','SMA/K')
        ->count();

        $dpl = DB::table('pend_terakhir')
        ->where('pendidikan','=','Diploma')
        ->count();

        $srj = DB::table('pend_terakhir')
        ->where('pendidikan','=','Sarjana')
        ->count();

        $mgr = DB::table('pend_terakhir')
        ->where('pendidikan','=','Magister')
        ->count();

        $dr = DB::table('pend_terakhir')
        ->where('pendidikan','=','Doktor')
        ->count();

        

        return view('simpeg.partials.main',compact(
                'tetap',
                'tdk_tetap',
                'tot_pegawai',
                'tot_jab',
                'tot_bag',
                'tot_pend',
                'pl',
                'pp',
                'smp',
                'sma',
                'dpl',
                'srj',
                'mgr',
                'dr'));
    }
}
