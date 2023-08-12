<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\MataKuliah;

use DB;

class RekapLaporanKehadiranController extends Controller
{
    public function index(Request $request)
    {
        $data['kelas'] = Kelas::all();

        if(auth()->user()->role->role_name == 'dosen') {
            $data['matkul'] = DB::table('mata_kuliah_enrolls')
                            ->selectRaw("mata_kuliah_enrolls.id_mata_kuliah as id, mata_kuliahs.nama_mata_kuliah")
                            ->join('mata_kuliahs', 'mata_kuliah_enrolls.id_mata_kuliah', '=', 'mata_kuliahs.id')
                            ->where('mata_kuliah_enrolls.id_dosen', auth()->user()->id)
                            ->groupBy('mata_kuliah_enrolls.id_mata_kuliah')
                            ->get();
        } else {
            $data['matkul'] = MataKuliah::all();
        }

        $data['laporan_kehadiran'] = [];
        $data['val_kelas'] = '';
        $data['val_matkul'] = '';

        if($_POST) {
            $dataPost = $request->except('_token');

            $mahasiswa = DB::table('kehadirans')
                        ->selectRaw("kehadirans.id_mahasiswa, users.name, users.identity_number")
                        ->join('users', 'kehadirans.id_mahasiswa', '=', 'users.id')
                        ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                        ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                        ->where('mata_kuliah_enrolls.id_kelas', $dataPost['kelas'])
                        ->where('mata_kuliah_enrolls.id_mata_kuliah', $dataPost['matkul'])
                        ->groupBy('kehadirans.id_mahasiswa')
                        ->get();

            $arrayResult = [];

            foreach ($mahasiswa as $row) {

                $arrayPertemuan = [];
                $jumlahSakit = 0;
                $jumlahIzin = 0;
                $jumlahAlpha = 0;
                $jumlahHadir = 0;

                for ($i=1; $i <=16 ; $i++) { 
                    
                    $kehadiran = DB::table('kehadirans')
                                ->selectRaw("kehadirans.status")
                                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                                ->where('kehadirans.id_mahasiswa', $row->id_mahasiswa)
                                ->where('mata_kuliah_enrolls.id_kelas', $dataPost['kelas'])
                                ->where('mata_kuliah_enrolls.id_mata_kuliah', $dataPost['matkul'])
                                ->where('pertemuan', $i)
                                ->first();
                    
                    if($kehadiran != null) {
                        if($kehadiran->status == 'hadir') {
                            $kodeKehadiran = 'H';

                            $jumlahHadir = $jumlahHadir + 1;
                        } elseif ($kehadiran->status == 'sakit') {
                            $kodeKehadiran = 'S';

                            $jumlahSakit = $jumlahSakit + 1;
                        } elseif ($kehadiran->status == 'ijin') {
                            $kodeKehadiran = 'I';

                            $jumlahIzin = $jumlahIzin + 1;
                        } elseif ($kehadiran->status == 'tanpa keterangan') {
                           $kodeKehadiran = 'A';

                           $jumlahAlpha = $jumlahAlpha + 1;
                        }
                    } else {
                        $kodeKehadiran = '-';
                    }

                    $arrayPertemuan[] = [$kodeKehadiran];

                }
                
                $arrayResult[] = [
                    'nama' => $row->name,
                    'nim' => $row->identity_number,
                    'pertemuan' => $arrayPertemuan,
                    'jum_izin' => $jumlahIzin,
                    'jum_sakit' => $jumlahSakit,
                    'jum_alpha' => $jumlahAlpha,
                    'jum_tidak_hadir' => $jumlahIzin + $jumlahSakit + $jumlahAlpha,
                    'jum_hadir' => $jumlahHadir,
                    'presentasi' => number_format((($jumlahHadir/16) * 100), 2)
                ];

            }

            $data['laporan_kehadiran'] = $arrayResult;
            $data['val_kelas'] = $dataPost['kelas'];
            $data['val_matkul'] = $dataPost['matkul'];

        }

        return view('rekap-laporan-kehadiran.index', $data);
    }
}
