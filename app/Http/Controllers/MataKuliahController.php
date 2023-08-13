<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\MataKuliahEnroll;
use App\Models\ProgramStudi;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;
use DB;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->role_name == 'admin jurusan') {
            $mata_kuliah = MataKuliah::where('id_prodi', auth()->user()->id_prodi)
                ->get();
            return view('mata-kuliah.index', compact('mata_kuliah'));
        } else {
            $mata_kuliah = MataKuliahEnroll::where('id_dosen', auth()->user()->id)
                // ->whereHas('mataKuliah',function($query){
                //     $query->where('status','aktif');
                // })
                ->get();
            $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();

            $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();
            $tahun = null;
            $semester = null;
            return view('mata-kuliah.index2', compact('mata_kuliah', 'tahun_ajaran', 'tahun', 'semester', 'angkatan'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prodi = ProgramStudi::where('id_jurusan', Auth::user()->prodi->id_jurusan)->get();

        return view('mata-kuliah.manage', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nama_mata_kuliah' => ['required'],
                'id_prodi' => ['required'],
                'kode_mata_kuliah' => ['required'],
                'sks' => ['required'],
                'status' => ['required'],
                'semester' => ['required'],
            ]);

            $data = $request->except('_token');

            MataKuliah::create($data);

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/mata-kuliah');
        } catch (\Throwable $th) {
            Session::flash('swal', [
                'title' => 'Add Data Failed',
                'text' => 'Harap mengisi form dengan benar!',
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
    public function show($id)
    {
        $mata_kuliah = MataKuliah::findorFail($id);
        if (Auth::user()->role->role_name == 'dosen') {
            $mata_kuliah_enroll = MataKuliahEnroll::where('id_mata_kuliah', $id)
                ->where('id_dosen', Auth::user()->id)
                ->get();
        } else {
            $mata_kuliah_enroll = MataKuliahEnroll::where('id_mata_kuliah', $id)->get();
        }

        $data = array(
            'data' => $mata_kuliah,
            'mata_kuliah_enroll' => $mata_kuliah_enroll,
        );

        return view('mata-kuliah.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prodi = ProgramStudi::where('id_jurusan', Auth::user()->prodi->id_jurusan)->get();
        $mata_kuliah = MataKuliah::findorFail($id);

        $data = array(
            'prodi' => $prodi,
            'data' => $mata_kuliah,
        );

        return view('mata-kuliah.manage', $data);
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
        try {
            $this->validate($request, [
                'nama_mata_kuliah' => ['required'],
                'id_prodi' => ['required'],
                'kode_mata_kuliah' => ['required'],
                'sks' => ['required'],
                'status' => ['required'],
                'semester' => ['required'],
            ]);

            $data = $request->except('_token');

            $mata_kuliah = MataKuliah::findorFail($id);
            $mata_kuliah->update($data);
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/mata-kuliah');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => $th->getMessage(),
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
    public function destroy($id)
    {
        try {
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => "Delete Data Success",
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            $mata_kuliah = MataKuliah::findorFail($id);

            $mata_kuliah->delete();
        } catch (\Throwable $th) {
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => $th->getMessage(),
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        }
        return redirect()->back();
    }

    public function filter(Request $request)
    {

        $kelas = Kelas::select('angkatan')->distinct()->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
        // if($request->tahun<>null AND $request->semester <> null AND $request->angkatan <> null ){
        $mata_kuliah = MataKuliahEnroll::with(['mataKuliah', 'kelas.tahunAjaran'])
            ->where('id_dosen', auth()->user()->id)
            ->when($request, function ($queri, $request) {
                if ($request->tahun <> null) {
                    $queri->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                        $query->where('tahun', $request->tahun);
                    });
                }
                if ($request->semester <> null) {
                    $queri->whereHas('kelas.tahunAjaran', function ($query) use ($request) {
                        $query->where('semester', $request->semester);
                    });
                }
                if ($request->angkatan <> null) {
                    $queri->whereHas('kelas', function ($query) use ($request) {
                        $query->where('angkatan', $request->angkatan);
                    });
                }
            })->get();

        $tahun = $request->tahun;
        $semester = $request->semester;
        $angkatanfilter = $request->angkatan;
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();


        return view('mata-kuliah.index2', compact('mata_kuliah', 'tahun_ajaran', 'tahun', 'semester', 'angkatan', 'angkatanfilter'));
    }
}
