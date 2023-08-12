<?php

namespace App\Http\Controllers;

use App\Models\DaftarNilai;
use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\MataKuliahEnroll;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasDetailController extends Controller
{
    public function indexDetailKehadiran($id_kelas, $id_jadwal) {
        $kelas = Kelas::findorFail($id_kelas);
        $jadwal = Jadwal::findorFail($id_jadwal);

        $kehadiran = Kehadiran::where('id_jadwal', $jadwal->id)
        ->select('pertemuan', DB::raw('count(*) as total'), 'tanggal', 'deskripsi')
        ->groupBy('pertemuan','tanggal','deskripsi')
        ->get();

        $data = array(
            'kelas' => $kelas,
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran,
        );

        return view('kelas-detail.indexkehadiran', $data);
    }

    public function indexDetailNilai($id_kelas, $id_matkul) {
        $kelas = Kelas::findorFail($id_kelas);
        $matkul = MataKuliahEnroll::findorFail($id_matkul);
        $kategori_nilai = DaftarNilai::where('id_mata_kuliah', $matkul->id_mata_kuliah)
        ->where('id_kelas', $matkul->id_kelas)
        ->get();

        $data = array(
            'kelas' => $kelas,
            'matkul' => $matkul,
            'kategori_nilai' => $kategori_nilai
        );

        return view('kelas-detail.indexnilai', $data);
    }

    public function showDetailNilai($id_kelas, $id_matkul, $id_kategori){
        $kelas = Kelas::findorFail($id_kelas);
        $daftar_nilai = DaftarNilai::findorFail($id_kategori);
        $matkul = MataKuliahEnroll::findorFail($id_matkul);
        $nilai = Nilai::where('id_daftar_nilai', $id_kategori)
        ->get();

        $data = array(
            'daftar_nilai' => $daftar_nilai,
            'matkul' => $matkul,
            'nilai' => $nilai,
            'kelas' => $kelas,
        );

        return view('kelas-detail.shownilai', $data);
    }

    public function showDetailKehadiran($id_kelas, $id_jadwal, $pertemuan){
        $kelas = Kelas::findorFail($id_kelas);
        $jadwal = Jadwal::findorFail($id_jadwal);


        $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
        ->where('pertemuan', $pertemuan)
        ->select('id_jadwal','pertemuan', 'tanggal','deskripsi')
        ->groupBy('id_jadwal','pertemuan','tanggal','deskripsi')
        ->first();

        $kehadiran_mahasiswa = Kehadiran::where('id_jadwal', $id_jadwal)
        ->where('pertemuan', $pertemuan)
        ->get();

        $data = array(
            'kelas' => $kelas,
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran_detail,
            'kehadiran_mahasiswa' => $kehadiran_mahasiswa
        );

        return view('kelas-detail.showkehadiran', $data);
    }
}
