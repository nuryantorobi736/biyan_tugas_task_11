<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Mahasantri;
class MahasantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ar_mahasantri = DB::table('mahasantri')
        ->join('dosen','dosen.id','=','mahasantri.dosen_id')
        ->join('matakuliah','matakuliah.id','=','dosen.matakuliah_id')
        ->join('jurusan','jurusan.id','=','mahasantri.jurusan_id')
        ->select('mahasantri.*','jurusan.nama AS jrs','dosen.nama AS dp',
        'matakuliah.nama AS mk')->get();
        return view('mahasantri.index',compact('ar_mahasantri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('mahasantri.c_mahasantri');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //1. proses validasi data
    $validasi = $request->validate(
    [
            'nama'=>'required|max:50',
             'nim'=>'required|unique:mahasantri|numeric',
            'dosen_id'=>'required',
            'matakuliah_id'=>'required',
            'jurusan_id'=>'required',
    ],
    //2. menampilkan pesan kesalahan
    //pesan kesalahan saat invalid data (kelanjutan slide sebelumnya)
    [
                'nama.required'=>'nama Wajib di Isi',      
                'nim.required'=>'NIM Wajib di Isi',
                'nim.unique'=>'Nim Tidak Boleh Sama',
                'nim.numeric'=>'Harus Berupa Angka',
                'dosen_id.required'=>'dosen di isi tidak boleh kosong',
                'matakuliah_id.required'=>'mata kuliah di isi tidak boleh kosong',
                'jurusan_id.required'=>'jurusan di isi tidak boleh kosong',
        ],
        );

    //3. proses input data tangkap request dari form input
    DB::table('mahasantri')->insert(
    [
    'nama'=>$request->nama,
    'nim'=>$request->nim,
    'dosen_id'=>$request->dosen_id,
    'jurusan_id'=>$request->jurusan_id,
    ]
    );
    //4.landing page
    return redirect()->route('mahasantri.index')->with('success','Data maha santri berhasil ditambahkan.');
    }   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //menampilkan detail mahasantri
        $ar_mahasantri = DB::table('mahasantri')
        ->join('dosen','dosen.id','=','mahasantri.dosen_id')
        ->join('matakuliah','matakuliah.id','=','dosen.matakuliah_id')
        ->join('jurusan','jurusan.id','=','mahasantri.jurusan_id')
        ->where('mahasantri.id','=',$id)->get();

        return view('mahasantri.show',compact('ar_mahasantri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = DB::table('mahasantri')->where('id','=',$id)->get();
         
        return view('mahasantri.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::table('mahasantri')->where('id','=',$id)->update(
            [
                'nama'=>$request->nama,
                'nim'=>$request->nim,
                'matakuliah'=>$request->matakuliah,
                'dosenpelajaran'=>$request->dosenpelajaran,
                'iddosen'=>$request->iddosen,
                'idjurusan'=>$request->idjurusan,
                'idmatakiliah'=>$request->idkategori,
            ]
        );

        return redirect('/mahasantri');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data 

        DB::table('mahasantri')->where('id',$id)->delete();

        return redirect('/mahasantri');
    }

    public function mahasantriPDF()
    {
        //
        $ar_mahasantri = DB::table('mahasantri')
        ->join('dosen','dosen.id','=','mahasantri.dosen_id')
        ->join('matakuliah','matakuliah.id','=','dosen.matakuliah_id')
        ->join('jurusan','jurusan.id','=','mahasantri.jurusan_id')
        ->select('mahasantri.*', 'pengarang.nama AS nama', 'penerbit.nama AS pen',
        'kategori.nama AS kat')->get(); 
$pdf = PDF::loadView('mahasantri/mahasantriPDF',['ar_mahasantri'=>$ar_mahasantri]);        
return $pdf->download('datamahasantri.pdf');
    }
}
