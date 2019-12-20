<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Jabatan;
use App\Bagian;
use App\pend_terakhir;
use DB;
use Validator,Redirect,Response,File;
use App\Exports\exportpegawai;
use App\Imports\importpegawai;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Auth;


class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = DB::table('jabatan')->get();
        $bagian = Bagian::all();
        $pegawai = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->leftjoin('pend_terakhir','pend_terakhir.pegawai_idpegawai','=','pegawai.idpegawai')
        ->orderBy('nama_pegawai','ASC')
        ->get();
        
        return view('simpeg.pegawai.index',compact('pegawai','jabatan','bagian'));
    }

    /**
     * Search Data On Index
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request) {

        $jabatan = Jabatan::all();
        $bagian = Bagian::all();

        $cari = $request->cari;

        $pegawai = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->where('nama_pegawai','like','%'.$cari.'%')
        ->orwhere('nama_jabatan','like','%'.$cari.'%')
        ->orwhere('nama_bagian','like','%'.$cari.'%')
        ->orwhere('jen_kel','like','%'.$cari.'%')
        ->orwhere('tmp_lahir','like','%'.$cari.'%')
        ->orwhere('tgl_lahir','like','%'.$cari.'%')
        ->orwhere('status','like','%'.$cari.'%')
        ->orwhere('agama','like','%'.$cari.'%')
        ->orwhere('tgl_masuk','like','%'.$cari.'%')
        ->orwhere('status_pegawai','like','%'.$cari.'%')
        ->orwhere('alamat','like','%'.$cari.'%')
        ->orwhere('email','like','%'.$cari.'%')
        ->orwhere('no_hp','like','%'.$cari.'%')
        ->orwhere('idbagian','like',$cari)
        ->paginate();


        return view('simpeg.pegawai.index',compact('pegawai','jabatan','bagian'));
        
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExport()
    {
       return view('import');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new exportpegawai, 'pegawai'.time().'.xlsx');
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new importpegawai, request()->file('file'));
            
        return back();
    }

    public function pdf() {
        $pegawai = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        ->join('pend_terakhir','pegawai.idpegawai','=','pend_terakhir.pegawai_idpegawai')
        ->orderBy('nama_pegawai','ASC')
        ->get();

        $pdf = PDF::loadview('simpeg.pegawai.cetak',['pegawai'=>$pegawai])
        ->setPaper('a3','landscape');

        return $pdf->download('pegawai'.time().'pdf');

        // return view('simpeg.pegawai.cetak',compact('pegawai'));
    }

    /**
     * Filter Data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function filter(Request $request) {
        
        $jabatan = Jabatan::all();
        $bagian = Bagian::all();
        $filter = $request->filter;

        $pegawai = DB::table('jabatan')
        ->join('bagian','jabatan.idjabatan','=','bagian.jabatan_idjabatan')
        ->join('pegawai','bagian.idbagian','=','pegawai.bagian_idbagian')
        // ->join('pend_terakhir','pend_terakhir.pegawai_idpegawai','=','pegawai.idpegawai')
        ->where('idjabatan',$filter)
        ->paginate();

        return view('simpeg.pegawai.index',compact('pegawai','jabatan','bagian'));
        
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

        $jk1 = ['jn_kel'=>'laki-laki'];
        $jk2 = ['jn_kel'=>'perempuan'];
        $jk = [$jk1,$jk2];

        $stts1 = ['status'=>'menikah'];
        $stts2 = ['status'=>'belum menikah'];
        $stts = [$stts1,$stts2];

        $agm1 = ['agama'=>'islam'];
        $agm = [$agm1];

        $sttsp1 = ['stts_pgw'=>'tetap'];
        $sttsp2 = ['stts_pgw'=>'tidak tetap'];
        $sttsp = [$sttsp1,$sttsp2];

        if (Auth::user()->role == 'admin') {
            return view('simpeg.pegawai.create', compact('jk','stts','agm','sttsp','pend'));
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
            // 'jabatan_idjabatan'=>'required',
            'bagian_idbagian'=>'required',
            'nama_pegawai'   =>'required',
            'jen_kel'        =>'required',
            'alamat'         =>'required',
            'tmp_lahir'      =>'required',
            'tgl_lahir'      =>'required',
            'status'         =>'required',
            'agama'          =>'required',
            'email'          =>'required|email|unique:pegawai',
            'tgl_masuk'      =>'required',
            'no_hp'          =>'required|unique:pegawai',
            'status_pegawai' =>'required',
            'pendidikan'                =>'required',
            'instansi'                  =>'required',
            'tahun_lulus'               =>'required',
            'gaji_pokok'        =>'required',
            'foto'=>'image|mimes:jpeg,png,jpg,|max:2048'],
            [
            // 'jabatan_idjabatan.required'=>'Jabatan wajib disi',
            'bagian_idbagian.required'=>'Bagian wajib disi',
            'nama_pegawai.required'   =>'Nama wajib disi',
            'jen_kel.required'        =>'Jenis Kelamin wajib disi',
            'alamat.required'         =>'Alamat wajib disi',
            'tmp_lahir.required'      =>'Tempat Lahir wajib disi',
            'tgl_lahir.required'      =>'Tanggal Lahir wajib disi',
            'status.required'         =>'Status wajib disi',
            'agama.required'          =>'Agama wajib disi',
            'email.required'          =>'Email wajib disi',
            'email.unique'            =>'Email sudah ada',
            'no_hp.required'          =>'No HP wajib disi',
            'no_hp.unique'            =>'No Hp sudah ada',
            'tgl_masuk.required'      =>'Tanggal masuk Wajib Diisi',
            'status_pegawai.required' =>'Status Pegawai wajib disi',
            'pendidikan.required'       =>'Mohon Pilih Pendidikan',
            'instansi.required'         =>'Nama Instansi Wajib Di Isi',
            'tahun_lulus.required'      =>'Tahun Kelulusan Wajib Di Isi',
            'gaji_pokok.required'      =>'Total Gaji Pokok Wajib Di Isi',
            'foto.max'=>'foto terlalu besar',
            ]);

            // if(!empty($request->foto)){
            //     $request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg,|max:2048',]);
            //     $namafile = $request->nama_pegawai.time().'.'.$request->foto->extension();
            //     $request->foto->move(public_path('images'), $namafile);
            // }else{
            //     $namafile=null;
            // }

    //   DB::table('pegawai')->insert([
    //         // 'jabatan_idjabatan'=>$request->jabatan_idjabatan,
    //         'bagian_idbagian'=>$request->bagian_idbagian,
    //         'idpegawai'      =>$request->idpegawai
    //                           .date('dmy', strtotime($request->tgl_lahir))
    //                           .date('dmy', strtotime($request->tgl_masuk))
    //                           .rand(1,1000),
    //         'nama_pegawai'   =>$request->nama_pegawai,
    //         'jen_kel'        =>$request->jen_kel,
    //         'alamat'         =>$request->alamat,
    //         'tmp_lahir'      =>$request->tmp_lahir,
    //         'tgl_lahir'      =>$request->tgl_lahir,
    //         'status'         =>$request->status,
    //         'agama'          =>$request->agama,
    //         'email'          =>$request->email,
    //         'no_hp'          =>$request->no_hp,
    //         'tgl_masuk'      =>$request->tgl_masuk,
    //         'status_pegawai' =>$request->status_pegawai,
    //         'foto'           =>$namafile]);
    //         return redirect('/pegawai')->with('sukses','Data Berhasil Disimpan');

            DB::transaction(function () use ($request) {

                if(!empty($request->foto)){
                    $request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg,|max:2048',]);
                    $namafile = $request->nama_pegawai.time().'.'.$request->foto->extension();
                    $request->foto->move(public_path('images'), $namafile);
                }else{
                    $namafile=null;
                }
                    DB::table('pegawai')->insert([
                        // 'jabatan_idjabatan'=>$request->jabatan_idjabatan,
                        'bagian_idbagian'=>$request->bagian_idbagian,
                        'idpegawai'      =>$request->idpegawai
                                          .date('dmy', strtotime($request->tgl_lahir))
                                          .date('dmy', strtotime($request->tgl_masuk)),
                                        //   .rand(1,1000),
                        'nama_pegawai'   =>$request->nama_pegawai,
                        'jen_kel'        =>$request->jen_kel,
                        'alamat'         =>$request->alamat,
                        'tmp_lahir'      =>$request->tmp_lahir,
                        'tgl_lahir'      =>$request->tgl_lahir,
                        'status'         =>$request->status,
                        'agama'          =>$request->agama,
                        'email'          =>$request->email,
                        'no_hp'          =>$request->no_hp,
                        'tgl_masuk'      =>$request->tgl_masuk,
                        'status_pegawai' =>$request->status_pegawai,
                        'foto'           =>$namafile]);

                    DB::table('pend_terakhir')->insert([
                        'idpendidikan'      =>'A'
                            .substr($request->pendidikan,0,2)
                            
                            .date('dmy')
                            .rand(10,1000),
                        'pegawai_idpegawai' =>$request->idpegawai
                                          .date('dmy', strtotime($request->tgl_lahir))
                                          .date('dmy', strtotime($request->tgl_masuk)),
                                        //   .rand(1,1000),
                        'pendidikan'        =>$request->pendidikan,
                        'instansi'          =>$request->instansi,
                        'tahun_lulus'       =>$request->tahun_lulus,
                        'gelar'             =>$request->gelar,]);

                    DB::table('gaji')->insert([
                        'idgaji'            =>'A'
                            
                            .date('dmy')
                            .rand(10,1000),
                        'pegawai_idpegawai' =>$request->idpegawai
                                          .date('dmy', strtotime($request->tgl_lahir))
                                          .date('dmy', strtotime($request->tgl_masuk)),
                                        //   .rand(1,1000),
                        'gaji_pokok'        =>$request->gaji_pokok,
                        'tunjab'            =>$request->tunjab,
                        'lain2'             =>$request->lain2,]);
            });
            return redirect('/pegawai')->with('sukses','Data Berhasil Disimpan');
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
    public function edit($id)
    {
        $pegawai = Pegawai::where('idpegawai', $id)->get();

        $jk1 = ['jn_kel'=>'laki-laki'];
        $jk2 = ['jn_kel'=>'perempuan'];
        $jk = [$jk1,$jk2];

        $stts1 = ['status'=>'menikah'];
        $stts2 = ['status'=>'belum menikah'];
        $stts = [$stts1,$stts2];

        $agm1 = ['agama'=>'islam'];
        $agm = [$agm1];

        $sttsp1 = ['stts_pgw'=>'tetap'];
        $sttsp2 = ['stts_pgw'=>'tidak tetap'];
        $sttsp = [$sttsp1,$sttsp2];

        if (Auth::user()->role == 'admin') {
            return view('simpeg.pegawai.edit', compact('pegawai','jk','stts','agm','sttsp'));
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
        $gambar = Pegawai::where('idpegawai', $id)->first();

        if(!empty($request->foto)){
            File::delete('images/'.$gambar->foto);
            $request->validate(['foto' => 'required|image|mimes:jpeg,png,jpg,|max:2048',]);
            $namafile = $request->nama_pegawai.time().'.'.$request->foto->extension();
            $request->foto->move(public_path('images'), $namafile);
        }else{
            $namafile=$gambar->foto;
        }
        $request->validate([
            // 'jabatan_idjabatan'=>'required',
            'bagian_idbagian'=>'required',
            'nama_pegawai'   =>'required',
            'jen_kel'        =>'required',
            'alamat'         =>'required',
            'tmp_lahir'      =>'required',
            'tgl_lahir'      =>'required',
            'status'         =>'required',
            'agama'          =>'required',
            'email'          =>'required',
            'tgl_masuk'      =>'required',
            'no_hp'          =>'required',
            'status_pegawai' =>'required',],
            [
            // 'jabatan_idjabatan.required'=>'Jabatan wajib disi',
            'bagian_idbagian.required'=>'Bagian wajib disi',
            'nama_pegawai.required'   =>'Nama wajib disi',
            'jen_kel.required'        =>'Jenis Kelamin wajib disi',
            'alamat.required'         =>'Alamat wajib disi',
            'tmp_lahir.required'      =>'Tempat Lahir wajib disi',
            'tgl_lahir.required'      =>'Tanggal Lahir wajib disi',
            'status.required'         =>'Status wajib disi',
            'agama.required'          =>'Agama wajib disi',
            'email.required'          =>'Email wajib disi',
            'no_hp.required'          =>'No HP wajib disi',
            'tgl_masuk.required'      =>'Tanggal masuk Wajib Diisi',
            'status_pegawai.required' =>'Status Pegawai wajib disi',
            'foto.max'                 =>'foto terlalu besar']);

       DB::table('pegawai')->where('idpegawai', $id)->update([
            // 'jabatan_idjabatan'=>$request->jabatan_idjabatan,
            'bagian_idbagian'=>$request->bagian_idbagian,
            'nama_pegawai'   =>$request->nama_pegawai,
            'jen_kel'        =>$request->jen_kel,
            'alamat'         =>$request->alamat,
            'tmp_lahir'      =>$request->tmp_lahir,
            'tgl_lahir'      =>$request->tgl_lahir,
            'status'         =>$request->status,
            'agama'          =>$request->agama,
            'email'          =>$request->email,
            'no_hp'          =>$request->no_hp,
            'tgl_masuk'      =>$request->tgl_masuk,
            'status_pegawai' =>$request->status_pegawai,
            'foto'           =>$namafile]);

            return redirect('/pegawai')->with('edit','Data Berhasil Diedit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::where('idpegawai', $id)->first();
        File::delete('images/'.$data->foto);

        DB::table('pegawai')->where('idpegawai',$id)->delete();
        return redirect('/pegawai')->with('hapus','');
    }
}
