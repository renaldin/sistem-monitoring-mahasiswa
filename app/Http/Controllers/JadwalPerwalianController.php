<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JadwalPerwalian;
use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\Perwalian;

use Session;
use DB;

class JadwalPerwalianController extends Controller
{
    public function index()
    {
        if (auth()->user()->role->role_name == 'dosen') {
            $perwalian = DB::table('jadwal_perwalian')
                ->selectRaw("jadwal_perwalian.*, kelas.nama_kelas")
                ->join('kelas', 'jadwal_perwalian.id_kelas', '=', 'kelas.id')
                ->where('jadwal_perwalian.id_dosen_wali', auth()->user()->id)
                ->get();

            return view('jadwal-perwalian.index', compact('perwalian'));
        } elseif (auth()->user()->role->role_name == 'mahasiswa') {
            $kelas = KelasEnroll::with('kelas')->where('id_mahasiswa', auth()->user()->id)->orderBy('id', 'desc')->first();
            // $perwalian = DB::table('jadwal_perwalian')
            //     ->selectRaw("jadwal_perwalian.*, kelas.nama_kelas")
            //     ->join('kelas', 'jadwal_perwalian.id_kelas', '=', 'kelas.id')
            //     ->where('jadwal_perwalian.id_kelas', $kelas->id_kelas)
            //     ->get();
            if ($kelas !== null) {
                $perwalian = DB::table('jadwal_perwalian')
                    ->selectRaw("jadwal_perwalian.*, kelas.nama_kelas")
                    ->join('kelas', 'jadwal_perwalian.id_kelas', '=', 'kelas.id')
                    ->where('jadwal_perwalian.id_dosen_wali', $kelas->kelas->id_dosen_wali)
                    ->get();

                $array = [];
                foreach ($perwalian as $row) {
                    $array[] = count(Perwalian::where(['id_mahasiswa' => auth()->user()->id, 'id_jadwal_perwalian' => $row->id])->get());
                }
            } else {
                $perwalian = null;
                $array = null;
            }

            return view('jadwal-perwalian.index', compact('perwalian', 'array'));
        }
    }


    public function create()
    {
        $data['kelas'] = DB::table('kelas')
            ->select("kelas.*", "tahun_ajarans.semester")
            ->join('tahun_ajarans', 'tahun_ajarans.id', '=', 'kelas.id_tahun_ajaran')
            ->where('kelas.id_dosen_wali', auth()->user()->id)
            ->where('kelas.status', 'aktif')
            ->first();

        return view('jadwal-perwalian.form-jadwal-perwalian', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kelas' => ['required'],
            'keterangan' => ['required'],
            'tanggal' => ['required']
        ]);

        $data = $request->except('_token');
        $data['id_dosen_wali'] = auth()->user()->id;

        JadwalPerwalian::create($data);

        return redirect('jadwal-perwalian');
    }


    public function edit($id)
    {
        // $perwalian = JadwalPerwalian::findorFail($id);
        $perwalian = DB::table('jadwal_perwalian')
            ->select('jadwal_perwalian.*', 'kelas.nama_kelas', 'tahun_ajarans.semester')
            ->join('kelas', 'kelas.id', '=', 'jadwal_perwalian.id_kelas', 'left')
            ->join('tahun_ajarans', 'tahun_ajarans.id', '=', 'kelas.id_tahun_ajaran', 'left')
            ->where('jadwal_perwalian.id', $id)
            ->first();

        $data = array(
            'data' => $perwalian
        );

        return view('jadwal-perwalian.form-jadwal-perwalian', $data);
    }


    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'balasan' => ['required']
        // ]);

        $data = $request->except('_token');

        $jadwal_perwalian = JadwalPerwalian::findOrfail($id);
        $jadwal_perwalian->update($data);

        return redirect('jadwal-perwalian');
    }


    public function destroy($id)
    {

        try {
            $jadwal_perwalian = JadwalPerwalian::findorFail($id);
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            $jadwal_perwalian->delete();
        } catch (\Throwable $th) {
            throw $th;
        }

        return redirect()->back();
    }
}
