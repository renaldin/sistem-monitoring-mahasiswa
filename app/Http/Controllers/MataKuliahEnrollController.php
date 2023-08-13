<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\MataKuliahEnroll;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MataKuliahEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kelas = Kelas::with('tahunAjaran')->get();
        $dosen = User::where([['id_role', '=', 3], ['id_prodi', '=', Auth::user()->id_prodi]])->get();

        $data = array(
            'kelas' => $kelas,
            'dosen' => $dosen,
            'id_mata_kuliah' => $id
        );

        return view('mata-kuliah-enroll.manage', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'id_kelas' => ['required'],
            // 'id_dosen' => ['required'],
        ]);

        if (auth()->user()->role->role_name == 'admin jurusan') {
            $data['id_dosen'] = $request->id_dosen;
        } else {
            $data['id_dosen'] = auth()->user()->id;
        }

        // check if exists
        $matkul_enroll = MataKuliahEnroll::where('id_mata_kuliah', $id)
            ->where('id_kelas', $request->id_kelas)
            ->where('id_dosen', $data['id_dosen'])
            ->exists();

        if ($matkul_enroll) {
            return redirect()->back()->with('error', 'Dosen yang dipilih sudah ada');
        }

        $data = array(
            'id_mata_kuliah' => $id,
            'id_kelas' => $request->id_kelas,
            'id_dosen' => $data['id_dosen'],
            'status_dosen' => $request->status_dosen,
        );

        $list_mahasiswa = KelasEnroll::where('id_kelas', $request->id_kelas)
            ->get();


        $mata_kuliah_enroll = MataKuliahEnroll::create($data);

        // foreach ($list_mahasiswa as $key => $value) {
        //     MahasiswaMataKuliahEnroll::create([
        //         'id_mata_kuliah_enroll' => $mata_kuliah_enroll->id,
        //         'id_mahasiswa' => $value->id_mahasiswa,
        //     ]);
        // }



        return redirect()->route('mata-kuliah.show', $id);
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
    public function edit($id, $id_enroll)
    {
        $kelas = Kelas::all();
        $dosen = User::where([['id_role', '=', 3], ['id_prodi', '=', Auth::user()->id_prodi]])->get();
        $mata_kuliah_enroll = MataKuliahEnroll::findorFail($id_enroll);

        $data = array(
            'kelas' => $kelas,
            'dosen' => $dosen,
            'id_mata_kuliah' => $id,
            'data' => $mata_kuliah_enroll,
        );

        return view('mata-kuliah-enroll.manage', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_enroll)
    {
        $this->validate($request, [
            'id_kelas' => ['required'],
            'id_dosen' => ['required'],
            'status_dosen' => ['required'],
        ]);

        if (auth()->user()->role->role_name == 'admin jurusan') {
            $data['id_dosen'] = $request->id_dosen;
        } else {
            $data['id_dosen'] = auth()->user()->id;
        }

        $data = array(
            'id_kelas' => $request->id_kelas,
            'id_dosen' => $request->id_dosen,
            'status_dosen' => $request->status_dosen,
        );

        // check if exists
        $matkul_enroll = MataKuliahEnroll::where('id_mata_kuliah', $id)
            ->where('id_kelas', $request->id_kelas)
            ->whereNotIn('id', [$id_enroll])
            ->where('id_dosen', $data['id_dosen'])
            ->exists();


        if ($matkul_enroll) {
            return redirect()->back()->with('error', 'Dosen yang dipilih sudah ada');
        }


        $mata_kuliah_enroll = MataKuliahEnroll::findorFail($id_enroll);
        MahasiswaMataKuliahEnroll::whereIn('id_mata_kuliah_enroll', [$mata_kuliah_enroll->id])->delete();

        $mata_kuliah_enroll->update($data);

        $list_mahasiswa = KelasEnroll::where('id_kelas', $request->id_kelas)
            ->get();


        // foreach ($list_mahasiswa as $key => $value) {
        //     MahasiswaMataKuliahEnroll::create([
        //         'id_mata_kuliah_enroll' => $mata_kuliah_enroll->id,
        //         'id_mahasiswa' => $value->id_mahasiswa,
        //     ]);
        // }

        return redirect()->route('mata-kuliah.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_enroll)
    {
        $mata_kuliah_enroll = MataKuliahEnroll::findorFail($id_enroll);
        $mata_kuliah_enroll->delete();

        MahasiswaMataKuliahEnroll::whereIn('id_mata_kuliah_enroll', [$mata_kuliah_enroll->id])->delete();

        return redirect()->route('mata-kuliah.show', $id);
    }
}
