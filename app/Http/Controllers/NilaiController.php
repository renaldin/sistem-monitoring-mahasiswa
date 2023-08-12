<?php

namespace App\Http\Controllers;

use App\Models\DaftarNilai as ModelsDaftarNilai;
use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\MataKuliah;
use App\Models\MataKuliahEnroll;
use App\Models\Nilai;
use App\Models\TahunAjaran;
use DaftarNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mata_kuliah = MataKuliahEnroll::where('id_dosen', auth()->user()->id)
        ->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
           
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();
        $tahun = null;
        $semester = null;
        $data = array(
            'mata_kuliah' => $mata_kuliah,
        );

        return view('nilai.index', $data, compact('mata_kuliah','tahun_ajaran','tahun','semester','angkatan'));
    }

    public function filter(Request $request)
    {
       
        $kelas = Kelas::select('angkatan')->distinct()->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
        // if($request->tahun<>null AND $request->semester <> null AND $request->angkatan <> null ){
            $mata_kuliah = MataKuliahEnroll::with(['mataKuliah', 'kelas.tahunAjaran'])
            ->where('id_dosen', auth()->user()->id)
            ->when($request, function($queri, $request) {
                if ($request->tahun <> null) {
                    $queri ->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                            $query->where('tahun', $request->tahun);
                                  
                        });
                   
                }
                if ($request->semester <> null) {
                    $queri ->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                            $query->where('semester', $request->semester);
                                  
                        });
                   
                }
                if ($request->angkatan <> null) {
                    $queri ->whereHas('kelas', function ($query) use ($request) {
                            $query->where('angkatan', $request->angkatan);
                                  
                        });
                   
                }
            })->get();

        $tahun = $request->tahun;
        $semester = $request->semester;
        $angkatanfilter = $request->angkatan;
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();


       return view('nilai.index', compact('mata_kuliah','tahun_ajaran','tahun','semester','angkatan','angkatanfilter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $matkul = MataKuliahEnroll::findorFail($id);
        $kategori_nilai = ModelsDaftarNilai::where('id_mata_kuliah', $matkul->id_mata_kuliah)
        ->where('id_kelas', $matkul->id_kelas)
        ->where('kategori_tugas','!=', 'tugas/kuis')
        ->get();

        $data = array(
            'matkul' => $matkul,
            'kategori_nilai' => $kategori_nilai
        );

        return view('nilai.create', $data);
    }

    public function createKategori($id)
    {
        $matkul = MataKuliahEnroll::findorFail($id);

        $data = array(
            'matkul' => $matkul,
        );

        return view('nilai.manage', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            //code...
            $this->validate($request, [
                'judul_kategori' => ['required'],
                'kategori_tugas' => ['required'],
            ]);
    
            $data = $request->except('_token');
            $matkul = MataKuliahEnroll::findorFail($id);
    
            $data['id_tahun_ajaran'] = $matkul->kelas->id_tahun_ajaran;
            $data['id_kelas'] = $matkul->kelas->id;
            $data['id_mata_kuliah'] = $matkul->mataKuliah->id;
    
            $daftar_nilai = ModelsDaftarNilai::create($data);
            $mahasiswa = MahasiswaMataKuliahEnroll::where('id_mata_kuliah_enroll',$id)->get();
            $nilai_tugas_kuis = [];
    
            foreach ($mahasiswa as $key => $res) {
                if ($data['kategori_tugas'] == 'nilai lain lain') {
                    $nilai_tugas_kuis = Nilai::with('daftarNilai')
                    ->whereHas('daftarNilai', function($query) {
                        $query->where('kategori_tugas', 'tugas/kuis');
                    })
                    ->select('id_mahasiswa', DB::raw('sum(nilai) as total'), DB::raw('count(*) as jumlah'))
                    ->groupBy('id_mahasiswa')
                    ->get();
    
                } else {
                    $value = new Nilai;
                    $value->id_daftar_nilai = $daftar_nilai->id;
                    $value->id_mahasiswa = $res->id_mahasiswa;
                    $value->nilai = 0;
                    $value->save();
                }
    
            }
    
    
    
            if ($data['kategori_tugas'] == 'nilai lain lain') {
                foreach ($nilai_tugas_kuis as $key => $value) {
                    $nilais = new Nilai;
                    $nilais->id_daftar_nilai = $daftar_nilai->id;
                    $nilais->id_mahasiswa = $value->id_mahasiswa;
                    // if ($value->total / $value->jumlah != 0) {
                    //     $nilais->nilai = ($value->total / $value->jumlah);
                    // } else {
                    //     $nilais->nilai = 0;
                    // }
                    $nilais->nilai = 0;
                    $nilais->save();
                }
            }

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

    
            return redirect()->route('nilai.create', $id);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_matkul, $id_nilai)
    {
        $daftar_nilai = ModelsDaftarNilai::findorFail($id_nilai);
        $matkul = MataKuliahEnroll::findorFail($id_matkul);
        $nilai = Nilai::where('id_daftar_nilai', $id_nilai)
        ->get();
        $data = array(
            'daftar_nilai' => $daftar_nilai,
            'matkul' => $matkul,
            'nilai' => $nilai,
        );

        return view('nilai.show', $data);
    }

    public function createNilai($id_matkul, $id_nilai)
    {
        $daftar_nilai = ModelsDaftarNilai::findorFail($id_nilai);
        $matkul = MataKuliahEnroll::findorFail($id_matkul);
        $mahasiswa = MahasiswaMataKuliahEnroll::where('id_mata_kuliah_enroll', $matkul->id)
        ->get();

        $data = array(
            'daftar_nilai' => $daftar_nilai,
            'matkul' => $matkul,
            'mahasiswa' => $mahasiswa,
        );

        return view('nilai.add', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_matkul ,$id_kategori, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_matkul , $id)
    {
        try {
            //code...
            $this->validate($request,[
                'nilai' => ['required','numeric']
            ]);
    
            $data = $request->except('_token');
            $data['id_daftar_nilai'] = $id;
    
            Nilai::create($data);
            
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('nilai.show', [$id_matkul, $id]);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyNilai($id_matkul ,$id_kategori, $id)
    {
        try {
            //code...
            Nilai::findorFail($id)->delete();
            
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('nilai.show', [$id_matkul, $id_kategori]);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            return redirect()->back();
        }
    }

    public function updated(Request $request){
        $nilai = $request->nilai;
        foreach ($nilai as $key => $res) {
            $nilai = Nilai::findorFail($res['id']);
            $nilai->nilai = $res['value'];
            $nilai->update();
        }

        return response()->json(['message' => 'Update success']);
    }

    public function indexTugas(){
        $mata_kuliah = MataKuliahEnroll::where('id_dosen', auth()->user()->id)
        ->get();
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();
        $tahun = null;
        $semester = null;
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();

        $data = array(
            'mata_kuliah' => $mata_kuliah,
        );

        return view('nilai-tugas.index', $data, compact('mata_kuliah','tahun_ajaran','tahun','semester','angkatan'));
    }

    public function filterTugas(Request $request)
    {
       
        $kelas = Kelas::select('angkatan')->distinct()->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
        // if($request->tahun<>null AND $request->semester <> null AND $request->angkatan <> null ){
            $mata_kuliah = MataKuliahEnroll::with(['mataKuliah', 'kelas.tahunAjaran'])
            ->where('id_dosen', auth()->user()->id)
            ->when($request, function($queri, $request) {
                if ($request->tahun <> null) {
                    $queri ->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                            $query->where('tahun', $request->tahun);
                                  
                        });
                   
                }
                if ($request->semester <> null) {
                    $queri ->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                            $query->where('semester', $request->semester);
                                  
                        });
                   
                }
                if ($request->angkatan <> null) {
                    $queri ->whereHas('kelas', function ($query) use ($request) {
                            $query->where('angkatan', $request->angkatan);
                                  
                        });
                   
                }
            })->get();

        $tahun = $request->tahun;
        $semester = $request->semester;
        $angkatanfilter = $request->angkatan;
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();


       return view('nilai-tugas.index', compact('mata_kuliah','tahun_ajaran','tahun','semester','angkatan','angkatanfilter'));
    }


    public function showTugas($id) {
        $matkul = MataKuliahEnroll::findorFail($id);
        $kategori_nilai = ModelsDaftarNilai::where('id_mata_kuliah', $matkul->id_mata_kuliah)
        ->where('id_kelas', $matkul->id_kelas)
        ->where('kategori_tugas', 'tugas/kuis')
        ->get();

        $data = array(
            'matkul' => $matkul,
            'kategori_nilai' => $kategori_nilai
        );

        return view('nilai-tugas.show', $data);
    }

    public function createTugas($id) {
        $matkul = MataKuliahEnroll::findorFail($id);

        $data = array(
            'matkul' => $matkul,
        );

        return view('nilai-tugas.manage',$data);
    }

    public function storeTugas(Request $request ,$id) {
        try {
            //code...
            $this->validate($request, [
                'judul_kategori' => ['required'],
                // 'kategori_tugas' => ['required'],
            ]);
    
            $data = $request->except('_token');
            $matkul = MataKuliahEnroll::findorFail($id);
    
            $data['id_tahun_ajaran'] = $matkul->kelas->id_tahun_ajaran;
            $data['id_kelas'] = $matkul->kelas->id;
            $data['id_mata_kuliah'] = $matkul->mataKuliah->id;
            $data['kategori_tugas'] = 'tugas/kuis';
    
            $daftar_nilai = ModelsDaftarNilai::create($data);
            $mahasiswa = MahasiswaMataKuliahEnroll::where('id_mata_kuliah_enroll',$id)->get();
    
            foreach ($mahasiswa as $key => $res) {
                $value = new Nilai;
                $value->id_daftar_nilai = $daftar_nilai->id;
                $value->id_mahasiswa = $res->id_mahasiswa;
                $value->nilai = 0;
                $value->save();
            }

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
    
            return redirect()->route('nilai.tugas.show', $id);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'error',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();
        }
    }

    public function showNilaiTugas($id_matkul, $id_kategori) {
        $daftar_nilai = ModelsDaftarNilai::findorFail($id_kategori);
        $matkul = MataKuliahEnroll::findorFail($id_matkul);
        $nilai = Nilai::where('id_daftar_nilai', $id_kategori)
        ->get();

        $data = array(
            'daftar_nilai' => $daftar_nilai,
            'matkul' => $matkul,
            'nilai' => $nilai,
        );

        return view('nilai-tugas.index2', $data);
    }


    public function generateNilai($id){
        $matkul = MataKuliahEnroll::findorFail($id);
        $mahasiswa = MahasiswaMataKuliahEnroll::where('id_mata_kuliah_enroll',$matkul->id)->get();
        // dd($mahasiswa);
        $kategori_nilai = [];
        foreach ($mahasiswa as $key => $value) {
            $kategori_nilai[$value->mahasiswa->name] = ModelsDaftarNilai::with('nilai','nilai.mahasiswa')
            ->whereHas('nilai',function($query) use ($value){
                $query->where('id_mahasiswa',$value->id_mahasiswa);
            })
            ->where('id_mata_kuliah', $matkul->id_mata_kuliah)
            ->where('id_kelas', $matkul->id_kelas)
            ->where('kategori_tugas','!=', 'tugas/kuis')
            ->get();
        }
        
        // dd($kategori_nilai);

        $data = array(
            'matkul' => $matkul,
            'kategori_nilai' => $kategori_nilai
        );
        
        return view('test.pdf-nilai', $data);
    }
}
