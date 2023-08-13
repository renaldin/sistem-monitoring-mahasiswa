<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\KelasEnroll;
use App\Models\Kehadiran;
use App\Models\Sp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

use DB;


class SpController extends Controller
{
    public function index()
    {
        if (Auth::guard('orang_tua')->user()) {
            $sp = Sp::where('id_user_penerima', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->get();
        } else {
            if (auth()->user()->id_role == '2') {
                $rekomen = Kehadiran::all();
                $groupedData = $rekomen->groupBy('id_mahasiswa');

                $rekomendasi = [];
                foreach ($groupedData as $id_mahasiswa => $attendanceRecords) {
                    $sumTerlambat = $attendanceRecords->sum('terlambat');
                    $mahasiswaName = $attendanceRecords->first()->mahasiswa->name;
                    $mahasiswaId = $attendanceRecords->first()->mahasiswa->id;

                    if ($sumTerlambat >= 120 && $sumTerlambat <= 240) {
                        $rekomensp = 'Surat Peringatan Lisan 1';
                    } elseif ($sumTerlambat >= 240 && $sumTerlambat <= 360) {
                        $rekomensp = 'Surat Peringatan Lisan 2';
                    } elseif ($sumTerlambat >= 360 && $sumTerlambat <= 480) {
                        $rekomensp = 'Surat Peringatan Lisan 3';
                    } elseif ($sumTerlambat >= 480 && $sumTerlambat <= 600) {
                        $rekomensp = 'Surat Peringatan Lisan 4';
                    } elseif ($sumTerlambat >= 600 && $sumTerlambat <= 720) {
                        $rekomensp = 'Surat Peringatan Terakhir 1';
                    } elseif ($sumTerlambat >= 720 && $sumTerlambat <= 840) {
                        $rekomensp = 'Surat Peringatan Terakhir 2';
                    } else {
                        $rekomensp = 'Surat Peringatan Terakhir 3';
                    }

                    $rekomendasi[] = [
                        'mahasiswa_id' => $mahasiswaId,
                        'mahasiswa' => $mahasiswaName,
                        'sum_terlambat' => $sumTerlambat,
                        'rekomen_sp' => $rekomensp,
                        'is_done' => count(Sp::where(['id_user_penerima' => $mahasiswaId, 'jenis_sp' => $rekomensp])->get())
                    ];
                }

                $sp = Sp::all();
                return view('sp.index', compact('sp', 'rekomendasi'));
            } else if (auth()->user()->id_role == '3') {
                $sp = Sp::join('kelas', 'sp.id_kelas', '=', 'kelas.id')
                    ->where('kelas.id_dosen_wali', auth()->user()->id)
                    ->get();
            } else {
                $sp = Sp::where('id_user_penerima', auth()->user()->id)
                    ->get();
            }
        }

        return view('sp.index', compact('sp'));
    }


    public function create()
    {
        $kelas = Kelas::where('id_prodi', auth()->user()->id_prodi)
            ->get();


        $data = array(
            'kelas' => $kelas
        );

        return view('sp.manage', $data);
    }

    public function getMahasiswa($id_kelas)
    {
        $mahasiswa = KelasEnroll::where('id_kelas', $id_kelas)
            ->join('users', 'kelas_enrolls.id_mahasiswa', '=', 'users.id')
            ->get();

        return response()->json(['data' => $mahasiswa]);
    }


    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'id_user_penerima' => ['required'],
                'deskripsi' => ['required'],
                'file' => ['required', 'file'],
            ]);

            $data = $request->except('_token');
            $file = $request->file('file');

            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->storeAs('public/sp', $file_name);

            $kelas = KelasEnroll::where('id_mahasiswa', $data['id_user_penerima'])
                ->orderBy('id', 'desc')
                ->first();

            $terlambat = DB::table('kehadirans')
                ->where('kehadirans.id_mahasiswa', '=', $data['id_user_penerima'])
                ->sum('kehadirans.terlambat');

            if ($terlambat >= 120 && $terlambat <= 240) {
                $rekomensp = 'Surat Peringatan Lisan 1';
            } elseif ($terlambat >= 240 && $terlambat <= 360) {
                $rekomensp = 'Surat Peringatan Lisan 2';
            } elseif ($terlambat >= 360 && $terlambat <= 480) {
                $rekomensp = 'Surat Peringatan Lisan 3';
            } elseif ($terlambat >= 480 && $terlambat <= 600) {
                $rekomensp = 'Surat Peringatan Lisan 4';
            } elseif ($terlambat >= 600 && $terlambat <= 720) {
                $rekomensp = 'Surat Peringatan Terakhir 1';
            } elseif ($terlambat >= 720 && $terlambat <= 840) {
                $rekomensp = 'Surat Peringatan Terakhir 2';
            } else {
                $rekomensp = 'Surat Peringatan Terakhir 3';
            }

            $data['jenis_sp'] = $rekomensp;
            $data['id_kelas'] = $kelas->id_kelas;
            $data['file'] = $file_name;
            $data['user_id'] = Auth::user()->id;
            Sp::create($data);

            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            // For send to dosen wali and orang tua

            return redirect('/sp');
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


    public function edit($id)
    {
        $sp = Sp::findorFail($id);
        $mahasiswa = User::where('id', $sp->id_user_penerima)->first();

        $data = array(
            'data' => $sp,
            'mahasiswa' => $mahasiswa
        );

        return view('sp.manage', $data);
    }


    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'id_user_penerima' => ['required'],
                'deskripsi' => ['required'],
                // 'file' => ['required','file'],
            ]);

            $data = $request->except('_token');
            $file = $request->file('file');
            $sp = Sp::findorFail($id);

            if (!empty($file)) {
                $old_path = 'public/sp/' . $sp->file;
                Storage::delete($old_path);
                $file_name = time() . "_" . $file->getClientOriginalName();
                $file->storeAs('public/sp', $file_name);
                $data['file'] = $file_name;
            }
            $data['user_id'] = Auth::user()->id;

            $sp->update($data);

            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);

            return redirect('/sp');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('swal', [
                'title' => 'Update Data',
                'text' => 'Harap Lengkapi Form',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $sp = Sp::findorFail($id);

        try {
            Session::flash('swal', [
                'title' => 'Delete Data',
                'text' => 'Success',
                'icon' => 'success',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            $sp->delete();
            $path = 'public/sp/' . $sp->file;
            Storage::delete($path);

            return redirect('/sp');
        } catch (\Throwable $th) {
            Session::flash('swal', [
                'title' => 'Add Data',
                'text' => 'Pertemuan Sudah Dibuat',
                'icon' => 'error',
                'timer' => 1500,
                'showConfirmButton' => false,
            ]);
            return redirect()->back();
        }
    }

    public function checkTerlambat($id)
    {
        $data['terlambat'] = DB::table('kehadirans')
            ->selectRaw("kehadirans.*, users.name as mahasiswa, jadwals.hari, mata_kuliah_enrolls.id_mata_kuliah, mata_kuliahs.nama_mata_kuliah")
            ->join('users', 'kehadirans.id_mahasiswa', '=', 'users.id')
            ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
            ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
            ->join('mata_kuliahs', 'mata_kuliah_enrolls.id_mata_kuliah', '=', 'mata_kuliahs.id')
            ->where('kehadirans.id_mahasiswa', $id)
            ->where('kehadirans.terlambat', '>', 0)
            ->get();

        return view('sp.terlambat-detail', $data);
    }

    public function kirimPeringatan($id)
    {
        $mahasiswa = User::where('id', $id)->first();

        $data = array(
            'mahasiswa' => $mahasiswa
        );

        return view('sp.manage', $data);
    }


    public function kirim()
    {

        // $token = '8233afc8ddee3653c46b286b9ee646bdad641929648039544f80a615edc2cd25';
        // $whatsapp_phone = "+62".$no_telepon;
        // $message = "Hallo ".$name."\n 1 Peminjaman Masuk! Perlu persetujuan anda \nKunjungi Website https://bmnpolsub.elearningpolsub.com";

        // $url = "https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp";
        // $data = [
        //     "phone" => $whatsapp_phone,
        //     "messageType" => "text",
        //     "body" => $message
        // ];

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // $headers = array(
        //     "API-Key: $token",
        //     "Content-Type: application/json",
        // );
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        // curl_exec($curl);
        // curl_close($curl);

        $sid = "ACe2939e5b5bf0fc7411154a346b811717";
        $token = "3ca1c088673feeeea046a6abb441de4e";
        $twilioNumber = "+14155238886";
        $recipientNumber = "+6283195739340";
        $client = new Client($sid, $token);

        $message = $client->messages->create(
            'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
            [
                'from' => 'whatsapp:' . $twilioNumber,
                'body' => "Anda telah menerima Surat Peringatan, silahkan cek surat di sistem Akademik Polsub",
            ]
        );
    }
}
