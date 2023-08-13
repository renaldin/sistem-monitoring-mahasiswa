<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\ProgramStudi;
use App\Models\MataKuliahEnroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;



class RekapKehadiranController extends Controller
{
    public function indexRekap()
    {
        if (Auth::user()->role->role_name == 'dosen') {
            $kelas = Kelas::where('id_dosen_wali', Auth::user()->id)
                ->get();
        } else {
            $kelas = Kelas::whereHas('prodi', function ($query) {
                $query->where('id_jurusan', Auth::user()->prodi->id_jurusan);
            })->get();
        }
        $angkatan = DB::table('kelas')->select('angkatan')->distinct()->get();
        $tahun = null;
        $semester = null;
        $tahun_ajaran = TahunAjaran::select('tahun')->distinct()->get();

        $data = array(
            'kelas' => $kelas
        );

        return view('rekap-kehadiran.index', $data, compact('kelas', 'angkatan', 'tahun', 'semester', 'tahun_ajaran'));
    }

    public function showRekap($id)
    {
        $kelas = Kelas::findorFail($id);

        $jadwal = Jadwal::with('mataKuliahEnroll')
            ->whereHas('mataKuliahEnroll', function ($query) use ($kelas) {
                $query->where('id_kelas', $kelas->id);
            })
            ->get();

        $data = array(
            'kelas' => $kelas,
            'jadwal' => $jadwal,
        );


        return view('rekap-kehadiran.show', $data);
    }

    public function detailRekap($id_kelas, $id_matkul_enroll)
    {
        $kelas = Kelas::findorFail($id_kelas);
        $jadwal = Jadwal::where('id_mata_kuliah_enroll', $id_matkul_enroll)
            ->first();

        if (empty($jadwal)) {
            return redirect()->back()->with('error', 'Mata kuliah ini belum ada jadwalnya');
        }

        $kehadiran = Kehadiran::where('id_jadwal', $jadwal->id)
            ->select('pertemuan', DB::raw('count(*) as total'), 'tanggal', 'deskripsi')
            ->groupBy('pertemuan', 'tanggal', 'deskripsi')
            ->get();

        $prodi = ProgramStudi::where('id', $kelas->id_prodi);

        $data = array(
            'kelas' => $kelas,
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran,
            'prodi' => $prodi,
        );



        return view('rekap-kehadiran.index2', $data);
    }

    public function detailRekapKehadiran($id_kelas, $id_jadwal, $pertemuan)
    {
        // $kelas = Kelas::findorFail($id_kelas);
        $kelas = Kelas::findorFail($id_kelas);
        $jadwal = Jadwal::findorFail($id_jadwal);


        $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
            ->where('pertemuan', $pertemuan)
            ->select('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->groupBy('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->first();

        $kehadiran_mahasiswa = Kehadiran::where('id_jadwal', $id_jadwal)
            ->where('pertemuan', $pertemuan)
            ->get();

        $data = array(
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran_detail,
            'kehadiran_mahasiswa' => $kehadiran_mahasiswa,
            'kelas' => $kelas,
        );



        return view('rekap-kehadiran.show2', $data);
    }

    //use if needed
    public function updateRekapPertemuan(Request $request, $id_kelas, $id_jadwal, $pertemuan)
    {
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
            return redirect()->back()->with('error', 'Pertemuan sudah dibuat');
        } else {
            Kehadiran::where('id_jadwal', $id_jadwal)
                ->where('pertemuan', $pertemuan)
                ->update(['deskripsi' => $data['deskripsi'], 'pertemuan' => $data['pertemuan'], 'tanggal' => $data['tanggal']]);
        }
        return redirect()->route('jadwal.show', $id_jadwal);
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


        return view('rekap-kehadiran.index', compact('kelas', 'tahun_ajaran', 'tahun', 'semester', 'angkatan', 'angkatanfilter'));
    }

    public function downloadPDF($id_kelas, $id_jadwal, $pertemuan)
    {
        // Retrieve the necessary data for generating the PDF
        // $kelas = Kelas::findOrFail($id_kelas);
        // $jadwal = Jadwal::findOrFail($id_jadwal);
        // $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
        //     ->where('pertemuan', $pertemuan)
        //     ->select('id_jadwal','pertemuan', 'tanggal','deskripsi')
        //     ->groupBy('id_jadwal','pertemuan','tanggal','deskripsi')
        //     ->first();
        // $kehadiran_mahasiswa = Kehadiran::where('id_jadwal', $id_jadwal)
        //     ->where('pertemuan', $pertemuan)
        // ->get();

        $jadwal = Jadwal::findorFail($id_jadwal);
        $kelas = Kelas::findorFail($id_kelas);


        $kehadiran_detail = Kehadiran::where('id_jadwal', $jadwal->id)
            ->where('pertemuan', $pertemuan)
            ->select('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->groupBy('id_jadwal', 'pertemuan', 'tanggal', 'deskripsi')
            ->first();

        $kehadiran_mahasiswa = Kehadiran::where('id_jadwal', $id_jadwal)
            ->where('pertemuan', $pertemuan)
            ->get();


        $data = [
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran_detail,
            'kehadiran_mahasiswa' => $kehadiran_mahasiswa,
            'kelas' => $kelas,
        ];





        // Generate the PDF using the "rekap-kehadiran/show2" view and the provided data


        // Set the file name for the downloaded PDF

        return view('test.pdf', $data);
        // Download the PDF file

        // $pdf = PDF::loadview('test.pdf',$data)->with('_blank');
        // return $pdf->download('laporan-pegawai.pdf');
    }

    public function downloadPDF2($id_kelas, $id_matkul_enroll)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $jadwal = Jadwal::where('id_mata_kuliah_enroll', $id_matkul_enroll)->first();

        if (empty($jadwal)) {
            return redirect()->back()->with('error', 'Mata kuliah ini belum ada jadwalnya');
        }

        $kehadiran = Kehadiran::with('jadwal')
            ->where('id_jadwal', $jadwal->id)
            ->get()
            ->groupBy('deskripsi');

        $count = $kehadiran->count();

        $prodi = ProgramStudi::findOrFail($kelas->id_prodi);

        $data = [
            'kelas' => $kelas,
            'jadwal' => $jadwal,
            'kehadiran' => $kehadiran,
            'prodi' => $prodi,
            'count' => $count
        ];



        return view('test.pdf2', $data);
    }
}
