<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\ProgramStudi;
use App\Models\TahunAjaran;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role->role_name == 'dosen') {
            $kelas = Kelas::whereHas('prodi',function($query){
                $query->where('id_jurusan',Auth::user()->prodi->id_jurusan);
            })
            ->where('id_dosen_wali', Auth::user()->id)
            ->get();
        } else {
            $kelas = Kelas::whereHas('prodi',function($query){
                $query->where('id_jurusan',Auth::user()->prodi->id_jurusan);
            })->get();
        }

        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();
        $tahun = null;
        $semester = null;
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();

        return view('kelas.index', compact('kelas','angkatan','tahun','semester','tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tahun_ajaran = TahunAjaran::all();
        $prodi = ProgramStudi::where('id_jurusan',Auth::user()->prodi->id_jurusan)->get();

        $data = array(
            'tahun_ajaran' => $tahun_ajaran,
            'prodi' => $prodi,
        );

        return view('kelas.manage', $data);
    }

    public function getDosen($id_prodi)
    {
        $dosen = User::where('id_prodi', $id_prodi)
        ->where('id_role', 3)
        ->get();

        return response()->json(['data' => $dosen]);
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
            //code...
            $this->validate($request, [
                'id_tahun_ajaran' => ['required'],
                'nama_kelas' => ['required'],
                'kode_kelas' => ['required'],
                'id_dosen_wali' => ['required'],
                'id_prodi' => ['required'],
                'status' => ['required'],
                'angkatan' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            Kelas::create($data);    
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/kelas');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => $th->getMessage(),
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
        $kelas = Kelas::findorFail($id);
        $kelas_enroll = KelasEnroll::where('id_kelas', $id)
        ->get();


        $data = array(
            'mahasiswa' => $kelas_enroll,
            'kelas' => $kelas,
        );

        return view('kelas.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tahun_ajaran = TahunAjaran::all();
        $prodi = ProgramStudi::where('id_jurusan',Auth::user()->prodi->id_jurusan)->get();
        $kelas = Kelas::findorFail($id);

        $data = array(
            'tahun_ajaran' => $tahun_ajaran,
            'prodi' => $prodi,
            'data' => $kelas,
        );

        return view('kelas.manage', $data);
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
            //code...
            $this->validate($request, [
                'id_tahun_ajaran' => ['required'],
                'nama_kelas' => ['required'],
                'kode_kelas' => ['required'],
                'id_dosen_wali' => ['required'],
                'id_prodi' => ['required'],
                'status' => ['required'],
                'angkatan' => ['required'],
            ]);
    
            $data = $request->except('_token');
    
            $kelas = Kelas::findorFail($id);
    
            $kelas->update($data);
    
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/kelas');
        } catch (\Throwable $th) {
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
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            
            $kelas = Kelas::findorFail($id);
    
            $kelas->delete();
    
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => $th->getMessage(),
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();
        }
    }

    public function showDetail($id)
    {
        $kelas = Kelas::findorFail($id);

        $jadwal = Jadwal::with('mataKuliahEnroll')
        ->whereHas('mataKuliahEnroll', function($query) use ($kelas){
            $query->where('id_kelas', $kelas->id);
        })
        ->get();

        $data = array(
            'kelas' => $kelas,
            'jadwal' => $jadwal,
        );

        return view('kelas.index2', $data);
    }

    public function filter(Request $request)
    {
     
        $kelas = Kelas::select('angkatan')->distinct()->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
        // if($request->tahun<>null AND $request->semester <> null AND $request->angkatan <> null ){
            $kelas = Kelas::whereHas('prodi', function ($query) {
                $query->where('id_jurusan', Auth::user()->prodi->id_jurusan);
            })
                ->where('status', 'aktif')
                ->where('id_dosen_wali', Auth::user()->id)
                ->when($request, function ($query) use ($request) {
                    if ($request->tahun !== null) {
                        $query->whereHas('tahunAjaran', function ($query) use ($request) {
                            $query->where('tahun', $request->tahun);
                        });
                    }
                    if ($request->semester !== null) {
                        $query->whereHas('tahunAjaran', function ($query) use ($request) {
                            $query->where('semester', $request->semester);
                        });
                    }
                    if ($request->angkatan !== null) {
                        $query->where('angkatan', $request->angkatan);
                    }
                })->get();

        
            
        $tahun = $request->tahun;
        $semester = $request->semester;
        $angkatanfilter = $request->angkatan;
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();


       return view('kelas.index', compact('kelas','tahun_ajaran','tahun','semester','angkatan','angkatanfilter'));
    }

    public function filterAdmin(Request $request)
    {
     
        $kelas = Kelas::select('angkatan')->distinct()->get();
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();
        // if($request->tahun<>null AND $request->semester <> null AND $request->angkatan <> null ){
            $kelas = Kelas::whereHas('prodi', function ($query) {
                $query->where('id_jurusan', Auth::user()->prodi->id_jurusan);
            })
                ->where('status', 'aktif')
                ->when($request, function ($query) use ($request) {
                    if ($request->tahun !== null) {
                        $query->whereHas('tahunAjaran', function ($query) use ($request) {
                            $query->where('tahun', $request->tahun);
                        });
                    }
                    if ($request->semester !== null) {
                        $query->whereHas('tahunAjaran', function ($query) use ($request) {
                            $query->where('semester', $request->semester);
                        });
                    }
                    if ($request->angkatan !== null) {
                        $query->where('angkatan', $request->angkatan);
                    }
                })->get();

        
            
        $tahun = $request->tahun;
        $semester = $request->semester;
        $angkatanfilter = $request->angkatan;
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();


       return view('kelas.index', compact('kelas','tahun_ajaran','tahun','semester','angkatan','angkatanfilter'));
    }
}
