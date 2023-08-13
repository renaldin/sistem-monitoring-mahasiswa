<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas_enroll = KelasEnroll::where('id_mahasiswa', auth()->user()->id)
            ->get();

        return view('kelas-enroll.index', compact('kelas_enroll'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kelas = Kelas::findorFail($id);

        $kelas_enroll = KelasEnroll::pluck('id_mahasiswa')->all();

        $list_mahasiswa = User::where('id_prodi', $kelas->id_prodi)
            ->where('id_role', '4')
            ->whereNotIn('id', $kelas_enroll)
            ->get();

        $data = array(
            'kelas' => $kelas,
            'list_mahasiswa' => $list_mahasiswa,
        );

        return view('kelas-enroll.manage', $data);
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
            'id_mahasiswa' => ['required']
        ]);

        $data = $request->except('_token');
        $kelas = Kelas::findorFail($id);

        $data['id_mahasiswa'] = $data['id_mahasiswa'];
        $data['id_kelas'] = $kelas->id;

        KelasEnroll::create($data);

        return redirect()->route('kelas.show', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    public function createMahasiswaKelasEnroll()
    {
        return view('kelas-enroll.manage2');
    }

    public function storeMahasiswaKelasEnroll(Request $request)
    {
        $this->validate($request, [
            'kode_kelas' => ['required']
        ]);
        $data = $request->except('_token');

        $kelas_enroll_exists = KelasEnroll::with('kelas')
            ->where('id_mahasiswa', Auth::user()->id)
            ->whereHas('kelas', function ($query) use ($data) {
                $query->where('kode_kelas', $data['kode_kelas']);
            })->exists();

        if ($kelas_enroll_exists) {
            return redirect()->back()->with('error', 'Kelas sudah diambil');
        } else {
            $kelas = Kelas::where('kode_kelas', $data['kode_kelas'])
                ->first();

            if ($kelas === null) {
                return redirect()->back()->with('error', 'Kelas tidak ada. Cek kembali kodenya!');
            }

            $data_enroll = array(
                'id_mahasiswa' => Auth::user()->id,
                'id_kelas' => $kelas->id,
            );

            KelasEnroll::create($data_enroll);

            return redirect()->route('mahasiswa-kelas.index');
        }
    }
}
