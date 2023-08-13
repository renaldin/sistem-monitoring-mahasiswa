<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\KelasEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\MataKuliahEnroll;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KehadiranController extends Controller
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
    public function create($id_jadwal)
    {
        $pertemuans = [];

        for ($i = 1; $i <= 16; $i++) {
            $pertemuans[] = $i;

            // $kehadiran_exists = Kehadiran::where('id_jadwal', $id_jadwal)
            // ->where('pertemuan', $i)
            // ->select('id_jadwal','pertemuan', 'tanggal','deskripsi')
            // ->groupBy('id_jadwal','pertemuan','tanggal','deskripsi')
            // ->exists();

            // if ($kehadiran_exists) {
            //    unset($pertemuans[$i]);
            // }
        }

        // dd($new_pertemuans);

        $data = array(
            'id_jadwal' => $id_jadwal,
            'pertemuans' => $pertemuans,
        );

        return view('kehadiran.manage', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_jadwal)
    {
        try {
            //code...
            $kehadiran = Kehadiran::where('id_jadwal', $id_jadwal)
                ->select('pertemuan', DB::raw('count(*) as total'), 'tanggal', 'deskripsi')
                ->groupBy('pertemuan', 'tanggal', 'deskripsi')
                ->get();
            foreach ($kehadiran as $item) {
                if ($request->tanggal === $item->tanggal) {
                    Session::flash('swal', [
                        'title' => 'Gagal',
                        'text' => 'Tanggal sudah ada',
                        'icon' => 'error',
                        'timer' => 4500,
                        'showConfirmButton' => false,
                    ]);
                    return redirect()->back();
                }
            }

            $this->validate($request, [
                'pertemuan' => ['required', 'min:1', 'max:16'],
                'tanggal' => ['required'],
                'deskripsi' => ['required'],
                // 'tanggal' => ['required'],
            ]);


            $today = Carbon::today();
            $tanggal = $today->toDateString();

            $data = $request->except('_token');
            $kehadiran_exists = Kehadiran::where('id_jadwal', $id_jadwal)
                ->where('pertemuan', $data['pertemuan'])
                ->select('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
                ->groupBy('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
                ->exists();

            if ($kehadiran_exists) {
                Session::flash('swal', [
                    'title' => 'Add Data',
                    'text' => 'Pertemuan Sudah Dibuat',
                    'icon' => 'error',
                    'timer' => 1500,
                    'showConfirmButton' => false,
                ]);
                return redirect()->back();
            }

            $jadwal = Jadwal::findorFail($id_jadwal);
            $mata_kuliah_enroll = MataKuliahEnroll::findorFail($jadwal->id_mata_kuliah_enroll);

            $mahasiswa = MahasiswaMataKuliahEnroll::with('mataKuliahEnroll')
                ->where('id_mata_kuliah_enroll', $mata_kuliah_enroll->id)
                ->whereHas('mataKuliahEnroll', function ($query) use ($mata_kuliah_enroll) {
                    $query->where('id_kelas', $mata_kuliah_enroll->id_kelas);
                })
                ->get();



            foreach ($mahasiswa as $key => $value) {
                $data = array(
                    'id_jadwal' => $jadwal->id,
                    'id_mahasiswa' => $value->id_mahasiswa,
                    'status' => null,
                    'tanggal' => $data['tanggal'],
                    'pertemuan' => $data['pertemuan'],
                    'deskripsi' => $data['deskripsi'],
                );

                Kehadiran::create($data);
            }

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect()->route('jadwal.show', $id_jadwal);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'Harap Lengkapi Form',
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
    public function show($id_jadwal, $pertemuan)
    {
        $jadwal = Jadwal::findorFail($id_jadwal);

        // $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
        // ->where('pertemuan', $pertemuan)
        // ->first();

        $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
            ->where('pertemuan', $pertemuan)
            ->select('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->groupBy('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->first();

        $kehadiran_mahasiswa = Kehadiran::where('id_jadwal', $id_jadwal)
            ->where('pertemuan', $pertemuan)
            ->get();


        $data = array(
            'kehadiran' => $kehadiran_detail,
            'kehadiran_mahasiswa' => $kehadiran_mahasiswa,
            'jadwal' => $jadwal,
        );


        return view('kehadiran.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jadwal, $pertemuan)
    {
        $jadwal = Jadwal::findorFail($id_jadwal);

        $pertemuan_kelas = Kehadiran::where('id_jadwal', $jadwal->id)
            ->select('pertemuan', DB::raw('count(*) as total'), 'tanggal', 'deskripsi')
            ->groupBy('pertemuan', 'tanggal', 'deskripsi')
            ->where('pertemuan', $pertemuan)
            ->first();


        $pertemuans = [];

        for ($i = 1; $i <= 16; $i++) {
            $pertemuans[] = $i;

            // $kehadiran_exists = Kehadiran::where('id_jadwal', $id_jadwal)
            // ->where('pertemuan', $i)
            // ->select('id_jadwal','pertemuan', 'tanggal','deskripsi')
            // ->groupBy('id_jadwal','pertemuan','tanggal','deskripsi')
            // ->exists();

            // if ($kehadiran_exists) {
            //    unset($pertemuans[$i]);
            // }
        }

        // dd($new_pertemuans);

        $data = array(
            'id_jadwal' => $id_jadwal,
            'pertemuans' => $pertemuans,
            'pertemuan_kelas' => $pertemuan_kelas,
        );

        return view('kehadiran.manage', $data);
    }

    public function updatePertemuan(Request $request, $id_jadwal, $pertemuan)
    {
        try {
            //code...
            $this->validate($request, [
                'pertemuan' => ['required', 'min:1', 'max:16'],
                'tanggal' => ['required'],
                'deskripsi' => ['required'],
                // 'tanggal' => ['required'],
            ]);
            $today = Carbon::today();
            $tanggal = $today->toDateString();

            $data = $request->except('_token');
            $kehadiran_exists = Kehadiran::where('id_jadwal', $id_jadwal)
                ->where('pertemuan', $data['pertemuan'])
                ->whereNotIn('pertemuan', [$pertemuan])
                ->select('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
                ->groupBy('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
                ->exists();

            if ($kehadiran_exists) {
                Session::flash('swal', [
                    'title' => 'Update Data',
                    'text' => 'Pertemuan Sudah Dibuat',
                    'icon' => 'error',
                    'timer' => 1500,
                    'showConfirmButton' => false,
                ]);

                return redirect()->back();
            } else {
                Kehadiran::where('id_jadwal', $id_jadwal)
                    ->where('pertemuan', $pertemuan)
                    ->update(['deskripsi' => $data['deskripsi'], 'pertemuan' => $data['pertemuan'], 'tanggal' => $data['tanggal']]);
            }
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            return redirect()->route('jadwal.show', $id_jadwal);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jadwal, $pertemuan)
    {
        try {
            //code...
            $this->validate($request, [
                'status' => ['required'],
            ]);
            $jadwal = Jadwal::findorFail($id_jadwal);
            $jam_mulai = Carbon::createFromFormat('H:i:s', $jadwal->jam_mulai);
            // $current_time = Carbon::now();

            $data = $request->except('_token');
            $array_combine = array_map(function ($value1, $value2, $value3) {
                return [
                    'id_kehadiran' => $value1,
                    'status' => $value2,
                    'terlambat' => $value3,
                ];
            }, $data['id_kehadiran'], $data['status'], $data['terlambat']);

            foreach ($array_combine as $key => $value) {
                $kehadiran = Kehadiran::findorFail($value['id_kehadiran']);
                // $jam_terlambat = $jam_mulai->diffInMinutes($value['jam_masuk_mahasiswa']);
                // if ($jam_mulai->lt($value['jam_masuk_mahasiswa'])) {
                //     // $kehadiran->terlambat = $jam_terlambat;
                // }
                $kehadiran->terlambat = $value['terlambat'];
                $kehadiran->status = $value['status'];
                // $kehadiran->jam_masuk_mahasiswa = $value['jam_masuk_mahasiswa'];

                $kehadiran->update();
            }
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Harap Lengkapi Form',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
        }

        return redirect()->back();
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

    public function addKeterlambatan(Request $request, $id_jadwal)
    {
        $data = $request->except('_token');
        $current_time = Carbon::now();

        $jadwal = Jadwal::findorFail($id_jadwal);
        $jam_terlambat = $current_time->diffInMinutes($jadwal->jam_mulai);

        // $mahasiswa = MahasiswaMataKuliahEnroll::where('id_mahasiswa', $data['mahasiswa'])
        // ->where('id_mata_kuliah_enroll', $jadwal->id_mata_kuliah_enroll)
        // ->get();

        $kehadiran = Kehadiran::where('id_jadwal', $id_jadwal)
            ->where('pertemuan', $data['pertemuan'])
            ->where('id_mahasiswa', $data['mahasiswa'])
            ->first();

        $kehadiran->terlambat = $jam_terlambat;
        $kehadiran->update();

        return $kehadiran;
    }

    public function updateKehadiran(Request $request, $id_jadwal)
    {
        $data = $request->except('_token');
        $jadwal = Jadwal::findorFail($id_jadwal);

        $kehadiran = Kehadiran::where('id', $data['id_kehadiran'])
            ->where('id_jadwal', $jadwal->id)
            ->first();

        $status = $data['isChecked'];

        // return $data['isChecked'];

        if ($status == 'true') {
            $kehadiran->status = 'hadir';
        } else {
            $kehadiran->status = null;
        }

        $kehadiran->update();

        return $kehadiran;
    }
}
