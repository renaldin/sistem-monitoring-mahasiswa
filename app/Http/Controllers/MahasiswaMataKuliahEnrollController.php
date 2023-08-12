<?php

namespace App\Http\Controllers;

use App\Models\DaftarNilai as ModelsDaftarNilai;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\MataKuliah;
use App\Models\MataKuliahEnroll;
use App\Models\Nilai;
use App\Models\User;
use Auth;
use DaftarNilai;
use Illuminate\Http\Request;

class MahasiswaMataKuliahEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('orang_tua')->user()){
            $mahasiswa_matkul_enroll = MahasiswaMataKuliahEnroll::where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)
            ->get();
        }else{
            $mahasiswa_matkul_enroll = MahasiswaMataKuliahEnroll::where('id_mahasiswa', auth()->user()->id)
            ->get();
        }

        return view('mahasiswa-mata-kuliah-enroll.index', compact('mahasiswa_matkul_enroll'));
    }

 /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas_enroll = KelasEnroll::where('id_mahasiswa', auth()->user()->id)
        ->get();

        return view('mahasiswa-mata-kuliah-enroll.manage', compact('kelas_enroll'));
    }

    public function getMatkul($id_kelas)
    {
        $mata_kuliah = MataKuliahEnroll::where('id_kelas', $id_kelas)
        ->with('mataKuliah')
        ->get();

        return response()->json(['data' => $mata_kuliah]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_mata_kuliah_enroll' => ['required'],
            'id_kelas' => ['required']
        ]);

        $data = $request->except('_token');
        $mahasiswa_matkul_enroll = MahasiswaMataKuliahEnroll::where('id_mahasiswa', auth()->user()->id)
        ->Where('id_mata_kuliah_enroll', $data['id_mata_kuliah_enroll'])
        ->exists();




        if (!$mahasiswa_matkul_enroll) {
            $data['id_mahasiswa'] = auth()->user()->id;
            $data['id_mata_kuliah_enroll'] = $request->id_mata_kuliah_enroll;

            MahasiswaMataKuliahEnroll::create($data);

            return redirect()->route('mahasiswa-mata-kuliah.index');
        } else {
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
        $mahasiswa_matkul_enroll = MahasiswaMataKuliahEnroll::findorFail($id);

        $jadwal = Jadwal::where('id_mata_kuliah_enroll', $mahasiswa_matkul_enroll->id_mata_kuliah_enroll)
        ->first();
        // $count = $absensi->count();

        if(Auth::guard('orang_tua')->user()){
            if (!empty($jadwal)) {
                $absensi = Kehadiran::where('id_jadwal', $jadwal->id)
                ->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->get();
            } else {
                $absensi = Kehadiran::with('jadwal')
                ->whereHas('jadwal', function($query) use ($mahasiswa_matkul_enroll){
                    $query->where('id_mata_kuliah_enroll',$mahasiswa_matkul_enroll->id);
                })
                ->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->get();
            }
        }else{
            if (!empty($jadwal)) {
                $absensi = Kehadiran::where('id_jadwal', $jadwal->id)
                ->where('id_mahasiswa', auth()->user()->id)
                ->get();
            } else {
                $absensi = Kehadiran::with('jadwal')
                ->whereHas('jadwal', function($query) use ($mahasiswa_matkul_enroll){
                    $query->where('id_mata_kuliah_enroll',$mahasiswa_matkul_enroll->id);
                })
                ->where('id_mahasiswa', auth()->user()->id)
                ->get();
            }
        }

        if(Auth::guard('orang_tua')->user()){
            $nilai = Nilai::join('daftar_nilais','nilais.id_daftar_nilai','=','daftar_nilais.id')
            ->where('daftar_nilais.id_mata_kuliah', $mahasiswa_matkul_enroll->mataKuliahEnroll->mataKuliah->id)
            ->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)
            ->whereNotIn('kategori_tugas',['nilai lain lain'])
            ->get();
        }else{
            $nilai = Nilai::join('daftar_nilais','nilais.id_daftar_nilai','=','daftar_nilais.id')
            ->where('daftar_nilais.id_mata_kuliah', $mahasiswa_matkul_enroll->mataKuliahEnroll->mataKuliah->id)
            ->where('id_mahasiswa', auth()->user()->id)
            ->whereNotIn('kategori_tugas',['nilai lain lain'])
            ->get();
        }


        $data = array(
            'mahasiswa' => $mahasiswa_matkul_enroll,
            'absensi' => $absensi,
            'nilai' => $nilai
        );

        return view('mahasiswa-mata-kuliah-enroll.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
