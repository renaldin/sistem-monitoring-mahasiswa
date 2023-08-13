<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\SP;
use App\Models\Jurusan;
use App\Models\Kehadiran;
use App\Models\Perwalian;
use App\Models\DaftarNilai;
use App\Models\ProgramStudi;
use App\Models\MataKuliahEnroll;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\User;
use Illuminate\Http\Request;

use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {

        $data = [];
        if (!Auth::guard('orang_tua')->user()) {
            if (Auth::user()->role->role_name == 'admin polsub') {
                $jurusan = Jurusan::count();
                $prodi = ProgramStudi::count();

                $arr = [];
                $mahasiswaprodi = ProgramStudi::get();

                foreach ($mahasiswaprodi as $key => $value) {



                    $arr[] = [
                        'prodi' => $value->nama_prodi,
                        'mahas_aktif' => User::where('status', 'aktif')->where('id_role', 4)->where('id_prodi', $value->id)->count(),
                        'mahas_tidak' => User::where('status', 'tidak aktif')->where('id_role', 4)->where('id_prodi', $value->id)->count()
                    ];
                }

                $data = array(
                    'jurusan' => $jurusan,
                    'prodi' => $prodi,
                    'mahasiswa_prodi' => $arr
                );
            } elseif (Auth::user()->role->role_name == 'mahasiswa') {
                $sp = Sp::where('id_user_penerima', Auth::user()->id)->count();

                $sakit = DB::table('kehadirans')
                    ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                    ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                    ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                    ->where('kelas.status', '=', 'aktif')
                    ->where('kehadirans.id_mahasiswa', '=', Auth::user()->id)
                    ->where('kehadirans.status', 'sakit')
                    ->get()
                    ->count();

                $izin = DB::table('kehadirans')
                    ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                    ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                    ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                    ->where('kelas.status', '=', 'aktif')
                    ->where('kehadirans.id_mahasiswa', '=', Auth::user()->id)
                    ->where('kehadirans.status', 'ijin')
                    ->get()
                    ->count();

                $tidak_hadir = DB::table('kehadirans')
                    ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                    ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                    ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                    ->where('kelas.status', '=', 'aktif')
                    ->where('kehadirans.id_mahasiswa', '=', Auth::user()->id)
                    ->where('kehadirans.status', 'tanpa keterangan')
                    ->get()
                    ->count();

                $terlambat = DB::table('kehadirans')
                    ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                    ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                    ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                    ->where('kelas.status', '=', 'aktif')
                    ->where('kehadirans.id_mahasiswa', '=', Auth::user()->id)
                    ->sum('kehadirans.terlambat');

                $perwalian = Perwalian::where('id_mahasiswa', Auth::user()->id)->latest()->first();
                if ($perwalian != []) {
                    $perwalian = $perwalian['created_at']->format('Y-m-d');
                } else {
                    $perwalian = '-';
                }

                // GET IPK
                $daftarNilai = DaftarNilai::with('mataKuliah', 'kelas', 'nilai', 'tahunAjaran')
                    ->whereHas('nilai', function ($query) {
                        $query->where('id_mahasiswa', Auth::user()->id);
                    })
                    ->latest()
                    ->get()
                    ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);

                $data = [];
                foreach ($daftarNilai as $num => $nilai) {
                    $totalSKS = 0;
                    $nilaiuts = 0;
                    $nilaitugas = 0;
                    $nilaiuas = 0;
                    $sigmaNilai = 0;
                    $ungroupedData = $nilai->flatten();
                    $firstData = $ungroupedData->first();
                    $kodeMatkul = $firstData->mataKuliah->kode_mata_kuliah;
                    $namaMatkul = $firstData->mataKuliah->nama_mata_kuliah;
                    $allData = $ungroupedData->where('id_mata_kuliah', $firstData->mataKuliah->id)->where('id_kelas', $firstData->kelas->id);
                    $semester = $firstData->tahunAjaran->semester;
                    $totalSKS = $firstData->mataKuliah->sks;

                    if (!empty($nilai['UTS'])) {
                        foreach ($allData->where('kategori_tugas', 'UTS') as $index => $uts) {
                            if (count($uts->nilai) > 0) {
                                $nilaiuts += $uts->nilai[0]->nilai;
                            } else {
                                $nilaiuts += 0;
                            }
                        }
                    }
                    if (!empty($nilai['UAS'])) {
                        foreach ($allData->where('kategori_tugas', 'UAS') as $index => $uas) {
                            if (count($uas->nilai) > 0) {
                                $nilaiuas += $uas->nilai[0]->nilai;
                            } else {
                                $nilaiuas += 0;
                            }
                        }
                    }
                    if (!empty($nilai['nilai lain lain'])) {
                        foreach ($allData->where('kategori_tugas', 'nilai lain lain') as $index => $tugas) {
                            if (count($tugas->nilai) > 0) {
                                $nilaitugas += $tugas->nilai[0]->nilai;
                            } else {
                                $nilaitugas += 0;
                            }
                        }
                        // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                    }
                    $nilaiTotal = $nilaitugas * 0.3 + $nilaiuts * 0.3 + $nilaiuas * 0.4;
                    $resultAngkaNilaiTotal = $nilaiTotal;
                    if ($nilaiTotal >= 85) {
                        $nilaiTotal = 4;
                    } elseif ($nilaiTotal >= 78) {
                        $nilaiTotal = 3.5;
                    } elseif ($nilaiTotal >= 70) {
                        $nilaiTotal = 3;
                    } elseif ($nilaiTotal >= 63) {
                        $nilaiTotal = 2.5;
                    } elseif ($nilaiTotal >= 55) {
                        $nilaiTotal = 2;
                    } elseif ($nilaiTotal >= 40) {
                        $nilaiTotal = 1;
                    } elseif ($nilaiTotal < 40) {
                        $nilaiTotal = 0;
                    }

                    $sigmaNilai += $totalSKS * $nilaiTotal;
                    $rataRata = $sigmaNilai / $totalSKS;
                    $resultAngkaRataRata = $rataRata;
                    if ($rataRata == 4) {
                        $rataRata = 'A';
                    } elseif ($rataRata >= 3.5) {
                        $rataRata = 'AB';
                    } elseif ($rataRata >= 3) {
                        $rataRata = 'B';
                    } elseif ($rataRata >= 2.5) {
                        $rataRata = 'C+';
                    } elseif ($rataRata >= 2) {
                        $rataRata = 'C';
                    } elseif ($rataRata >= 1) {
                        $rataRata = 'D';
                    } elseif ($rataRata < 1) {
                        $rataRata = 'E';
                    }
                    $resultRataRata =  $rataRata;
                    $nilaiAngka = $sigmaNilai / $totalSKS;

                    // IPS
                    // dd($resultAngkaNilaiTotal);
                    $data[] = array(
                        'kodeMataKuliah' => $kodeMatkul,
                        'namaMataKuliah' => $namaMatkul,
                        'semester' => $semester,
                        'totalSKS' => $totalSKS,
                        'nilaiAngka' => $nilaiAngka,
                        'nilaiRataRata' => $resultRataRata,
                        'nilaiAngkaNilaiTotal' => $resultAngkaNilaiTotal,
                        'sigmaNilai' => $sigmaNilai,
                        'totalSKS' => $totalSKS,
                    );
                }

                $allSKS = 0;
                $poin = 0;
                $ipk = 0;
                foreach ($data as $key => $value) {
                    $allSKS += $value['totalSKS'];
                    $poin += $value['sigmaNilai'];
                }

                if ($poin != 0 && $allSKS != 0) {
                    $ipk = number_format($poin / $allSKS, 2, '.', '');
                }

                // GET SEMESTER

                $getSemester = MahasiswaMatakuliahEnroll::with('mataKuliahEnroll.mataKuliah')->where('id_mahasiswa', Auth::user()->id)
                    ->whereHas('matakuliahEnroll.mataKuliah', function ($query) {
                        $query->orderBy('semester', 'desc');
                    })
                    ->latest()
                    ->first();

                // $daftarNilais = [];

                $daftarNilais = DaftarNilai::with('mataKuliah', 'kelas', 'nilai', 'tahunAjaran')
                    ->whereHas('nilai', function ($query) {
                        $query->where('id_mahasiswa', Auth::user()->id);
                    })
                    ->whereHas('tahunAjaran', function ($query) use ($getSemester) {
                        $query->where('semester', $getSemester == null ? 0 : $getSemester->mataKuliahEnroll->mataKuliah->semester);
                    })
                    ->latest()
                    ->get()
                    ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);

                $datas = [];
                foreach ($daftarNilais as $num => $nilai) {
                    $totalSKS = 0;
                    $nilaiuts = 0;
                    $nilaitugas = 0;
                    $nilaiuas = 0;
                    $sigmaNilai = 0;
                    $ungroupedData = $nilai->flatten();
                    $firstData = $ungroupedData->first();
                    $kodeMatkul = $firstData->mataKuliah->kode_mata_kuliah;
                    $namaMatkul = $firstData->mataKuliah->nama_mata_kuliah;
                    $allData = $ungroupedData->where('id_mata_kuliah', $firstData->mataKuliah->id)->where('id_kelas', $firstData->kelas->id);
                    $semester = $firstData->tahunAjaran->semester;
                    $totalSKS = $firstData->mataKuliah->sks;

                    if (!empty($nilai['UTS'])) {
                        foreach ($allData->where('kategori_tugas', 'UTS') as $index => $uts) {
                            if (count($uts->nilai) > 0) {
                                $nilaiuts += $uts->nilai[0]->nilai;
                            } else {
                                $nilaiuts += 0;
                            }
                        }
                    }
                    if (!empty($nilai['UAS'])) {
                        foreach ($allData->where('kategori_tugas', 'UAS') as $index => $uas) {
                            if (count($uas->nilai) > 0) {
                                $nilaiuas += $uas->nilai[0]->nilai;
                            } else {
                                $nilaiuas += 0;
                            }
                        }
                    }
                    if (!empty($nilai['nilai lain lain'])) {
                        foreach ($allData->where('kategori_tugas', 'nilai lain lain') as $index => $tugas) {
                            if (count($tugas->nilai) > 0) {
                                $nilaitugas += $tugas->nilai[0]->nilai;
                            } else {
                                $nilaitugas += 0;
                            }
                        }
                        // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                    }
                    $nilaiTotal = $nilaitugas * 0.3 + $nilaiuts * 0.3 + $nilaiuas * 0.4;
                    $resultAngkaNilaiTotal = $nilaiTotal;
                    if ($nilaiTotal >= 85) {
                        $nilaiTotal = 4;
                    } elseif ($nilaiTotal >= 78) {
                        $nilaiTotal = 3.5;
                    } elseif ($nilaiTotal >= 70) {
                        $nilaiTotal = 3;
                    } elseif ($nilaiTotal >= 63) {
                        $nilaiTotal = 2.5;
                    } elseif ($nilaiTotal >= 55) {
                        $nilaiTotal = 2;
                    } elseif ($nilaiTotal >= 40) {
                        $nilaiTotal = 1;
                    } elseif ($nilaiTotal < 40) {
                        $nilaiTotal = 0;
                    }

                    $sigmaNilai += $totalSKS * $nilaiTotal;
                    $rataRata = $sigmaNilai / $totalSKS;
                    $resultAngkaRataRata = $rataRata;
                    if ($rataRata == 4) {
                        $rataRata = 'A';
                    } elseif ($rataRata >= 3.5) {
                        $rataRata = 'AB';
                    } elseif ($rataRata >= 3) {
                        $rataRata = 'B';
                    } elseif ($rataRata >= 2.5) {
                        $rataRata = 'C+';
                    } elseif ($rataRata >= 2) {
                        $rataRata = 'C';
                    } elseif ($rataRata >= 1) {
                        $rataRata = 'D';
                    } elseif ($rataRata < 1) {
                        $rataRata = 'E';
                    }
                    $resultRataRata =  $rataRata;
                    $nilaiAngka = $sigmaNilai / $totalSKS;

                    // IPS
                    // dd($resultAngkaNilaiTotal);
                    $datas[] = array(
                        'kodeMataKuliah' => $kodeMatkul,
                        'namaMataKuliah' => $namaMatkul,
                        'semester' => $semester,
                        'totalSKS' => $totalSKS,
                        'nilaiAngka' => $nilaiAngka,
                        'nilaiRataRata' => $resultRataRata,
                        'nilaiAngkaNilaiTotal' => $resultAngkaNilaiTotal,
                        'sigmaNilai' => $sigmaNilai,
                        'totalSKS' => $totalSKS,
                    );
                }

                $allSKSIPS = 0;
                $poins = 0;
                $ips = 0;
                foreach ($datas as $key => $value) {
                    $allSKSIPS += $value['totalSKS'];
                    $poins += $value['sigmaNilai'];
                }

                if ($poins != 0 && $allSKSIPS != 0) {
                    $ips = number_format($poins / $allSKSIPS, 2, '.', '');
                }

                $data = array(
                    'sp' => $sp,
                    'sakit' => $sakit,
                    'izin' => $izin,
                    'tidak_hadir' => $tidak_hadir,
                    'terlambat' => $terlambat,
                    'perwalian' => $perwalian,
                    'ipk' => $ipk,
                    'ips' => $ips,
                    'semester' => $getSemester
                );
            } elseif (Auth::user()->role->role_name == 'dosen') {
                $matkul = DB::table('mata_kuliah_enrolls')
                    ->selectRaw("mata_kuliah_enrolls.*, mata_kuliahs.status")
                    ->join('mata_kuliahs', 'mata_kuliah_enrolls.id_mata_kuliah', '=', 'mata_kuliahs.id')
                    ->where('mata_kuliah_enrolls.id_dosen', Auth::user()->id)
                    ->where('mata_kuliahs.status', 'aktif')
                    ->count();

                $sp = DB::table('sp')
                    ->selectRaw("sp.*")
                    ->join('kelas', 'sp.id_kelas', '=', 'kelas.id')
                    ->where('kelas.id_dosen_wali', Auth::user()->id)
                    ->count();

                $data = array(
                    'matkul' => $matkul,
                    'sp' => $sp
                );
            } else if (Auth::user()->role->role_name == 'admin jurusan') {
                $sp = Sp::where('user_id', Auth::user()->id)->count();

                $userProdi = DB::table('users')
                    ->join('program_studis', 'program_studis.id', '=', 'users.id_prodi', 'left')
                    ->where('users.id', Auth::user()->id)->first();

                $jurusan = Jurusan::count();
                $prodi = ProgramStudi::count();

                $arr = [];
                $mahasiswaprodi = ProgramStudi::get();

                foreach ($mahasiswaprodi as $key => $value) {



                    $arr[] = [
                        'id_prodi' => $value->id,
                        'id_jurusan' => $value->id_jurusan,
                        'prodi' => $value->nama_prodi,
                        'mahas_aktif' => User::where('status', 'aktif')->where('id_role', 4)->where('id_prodi', $value->id)->count(),
                        'mahas_tidak' => User::where('status', 'tidak aktif')->where('id_role', 4)->where('id_prodi', $value->id)->count()
                    ];
                }

                $data = array(
                    'sp' => $sp,
                    'jurusan' => $jurusan,
                    'userProdi' => $userProdi,
                    'prodi' => $prodi,
                    'mahasiswa_prodi' => $arr
                );
            }
        } else {

            $sakit = DB::table('kehadirans')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', '=', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->where('kehadirans.status', 'sakit')
                ->get()
                ->count();

            $izin = DB::table('kehadirans')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', '=', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->where('kehadirans.status', 'ijin')
                ->get()
                ->count();

            $tidak_hadir = DB::table('kehadirans')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', '=', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->where('kehadirans.status', 'tanpa keterangan')
                ->get()
                ->count();

            $terlambat = DB::table('kehadirans')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', '=', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->sum('kehadirans.terlambat');

            $perwalian = Perwalian::where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)->latest()->first();
            if ($perwalian != []) {
                $perwalian = $perwalian['created_at']->format('Y-m-d');
            } else {
                $perwalian = '-';
            }

            // GET IPK
            $daftarNilai = DaftarNilai::with('mataKuliah', 'kelas', 'nilai', 'tahunAjaran')
                ->whereHas('nilai', function ($query) {
                    $query->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa);
                })
                ->latest()
                ->get()
                ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);

            $data = [];
            foreach ($daftarNilai as $num => $nilai) {
                $totalSKS = 0;
                $nilaiuts = 0;
                $nilaitugas = 0;
                $nilaiuas = 0;
                $sigmaNilai = 0;
                $ungroupedData = $nilai->flatten();
                $firstData = $ungroupedData->first();
                $kodeMatkul = $firstData->mataKuliah->kode_mata_kuliah;
                $namaMatkul = $firstData->mataKuliah->nama_mata_kuliah;
                $allData = $ungroupedData->where('id_mata_kuliah', $firstData->mataKuliah->id)->where('id_kelas', $firstData->kelas->id);
                $semester = $firstData->tahunAjaran->semester;
                $totalSKS = $firstData->mataKuliah->sks;

                if (!empty($nilai['UTS'])) {
                    foreach ($allData->where('kategori_tugas', 'UTS') as $index => $uts) {
                        if (count($uts->nilai) > 0) {
                            $nilaiuts += $uts->nilai[0]->nilai;
                        } else {
                            $nilaiuts += 0;
                        }
                    }
                }
                if (!empty($nilai['UAS'])) {
                    foreach ($allData->where('kategori_tugas', 'UAS') as $index => $uas) {
                        if (count($uas->nilai) > 0) {
                            $nilaiuas += $uas->nilai[0]->nilai;
                        } else {
                            $nilaiuas += 0;
                        }
                    }
                }
                if (!empty($nilai['nilai lain lain'])) {
                    foreach ($allData->where('kategori_tugas', 'nilai lain lain') as $index => $tugas) {
                        if (count($tugas->nilai) > 0) {
                            $nilaitugas += $tugas->nilai[0]->nilai;
                        } else {
                            $nilaitugas += 0;
                        }
                    }
                    // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                }
                $nilaiTotal = $nilaitugas * 0.3 + $nilaiuts * 0.3 + $nilaiuas * 0.4;
                $resultAngkaNilaiTotal = $nilaiTotal;
                if ($nilaiTotal >= 85) {
                    $nilaiTotal = 4;
                } elseif ($nilaiTotal >= 78) {
                    $nilaiTotal = 3.5;
                } elseif ($nilaiTotal >= 70) {
                    $nilaiTotal = 3;
                } elseif ($nilaiTotal >= 63) {
                    $nilaiTotal = 2.5;
                } elseif ($nilaiTotal >= 55) {
                    $nilaiTotal = 2;
                } elseif ($nilaiTotal >= 40) {
                    $nilaiTotal = 1;
                } elseif ($nilaiTotal < 40) {
                    $nilaiTotal = 0;
                }

                $sigmaNilai += $totalSKS * $nilaiTotal;
                $rataRata = $sigmaNilai / $totalSKS;
                $resultAngkaRataRata = $rataRata;
                if ($rataRata == 4) {
                    $rataRata = 'A';
                } elseif ($rataRata >= 3.5) {
                    $rataRata = 'AB';
                } elseif ($rataRata >= 3) {
                    $rataRata = 'B';
                } elseif ($rataRata >= 2.5) {
                    $rataRata = 'C+';
                } elseif ($rataRata >= 2) {
                    $rataRata = 'C';
                } elseif ($rataRata >= 1) {
                    $rataRata = 'D';
                } elseif ($rataRata < 1) {
                    $rataRata = 'E';
                }
                $resultRataRata =  $rataRata;
                $nilaiAngka = $sigmaNilai / $totalSKS;

                // IPS
                // dd($resultAngkaNilaiTotal);
                $data[] = array(
                    'kodeMataKuliah' => $kodeMatkul,
                    'namaMataKuliah' => $namaMatkul,
                    'semester' => $semester,
                    'totalSKS' => $totalSKS,
                    'nilaiAngka' => $nilaiAngka,
                    'nilaiRataRata' => $resultRataRata,
                    'nilaiAngkaNilaiTotal' => $resultAngkaNilaiTotal,
                    'sigmaNilai' => $sigmaNilai,
                    'totalSKS' => $totalSKS,
                );
            }

            $allSKS = 0;
            $poin = 0;
            $ipk = 0;
            foreach ($data as $key => $value) {
                $allSKS += $value['totalSKS'];
                $poin += $value['sigmaNilai'];
            }

            if ($poin != 0 && $allSKS != 0) {
                $ipk = number_format($poin / $allSKS, 2, '.', '');
            }

            // GET SEMESTER

            $getSemester = MahasiswaMatakuliahEnroll::with('mataKuliahEnroll.mataKuliah')->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa)
                ->whereHas('matakuliahEnroll.mataKuliah', function ($query) {
                    $query->orderBy('semester', 'desc');
                })
                ->latest()
                ->first();

            $daftarNilais = DaftarNilai::with('mataKuliah', 'kelas', 'nilai', 'tahunAjaran')
                ->whereHas('nilai', function ($query) {
                    $query->where('id_mahasiswa', Auth::guard('orang_tua')->user()->id_mahasiswa);
                })
                ->whereHas('tahunAjaran', function ($query) use ($getSemester) {
                    $query->where('semester', $getSemester->mataKuliahEnroll->mataKuliah->semester);
                })
                ->latest()
                ->get()
                ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);
            $datas = [];
            foreach ($daftarNilais as $num => $nilai) {
                $totalSKS = 0;
                $nilaiuts = 0;
                $nilaitugas = 0;
                $nilaiuas = 0;
                $sigmaNilai = 0;
                $ungroupedData = $nilai->flatten();
                $firstData = $ungroupedData->first();
                $kodeMatkul = $firstData->mataKuliah->kode_mata_kuliah;
                $namaMatkul = $firstData->mataKuliah->nama_mata_kuliah;
                $allData = $ungroupedData->where('id_mata_kuliah', $firstData->mataKuliah->id)->where('id_kelas', $firstData->kelas->id);
                $semester = $firstData->tahunAjaran->semester;
                $totalSKS = $firstData->mataKuliah->sks;

                if (!empty($nilai['UTS'])) {
                    foreach ($allData->where('kategori_tugas', 'UTS') as $index => $uts) {
                        if (count($uts->nilai) > 0) {
                            $nilaiuts += $uts->nilai[0]->nilai;
                        } else {
                            $nilaiuts += 0;
                        }
                    }
                }
                if (!empty($nilai['UAS'])) {
                    foreach ($allData->where('kategori_tugas', 'UAS') as $index => $uas) {
                        if (count($uas->nilai) > 0) {
                            $nilaiuas += $uas->nilai[0]->nilai;
                        } else {
                            $nilaiuas += 0;
                        }
                    }
                }
                if (!empty($nilai['nilai lain lain'])) {
                    foreach ($allData->where('kategori_tugas', 'nilai lain lain') as $index => $tugas) {
                        if (count($tugas->nilai) > 0) {
                            $nilaitugas += $tugas->nilai[0]->nilai;
                        } else {
                            $nilaitugas += 0;
                        }
                    }
                    // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                }
                $nilaiTotal = $nilaitugas * 0.3 + $nilaiuts * 0.3 + $nilaiuas * 0.4;
                $resultAngkaNilaiTotal = $nilaiTotal;
                if ($nilaiTotal >= 85) {
                    $nilaiTotal = 4;
                } elseif ($nilaiTotal >= 78) {
                    $nilaiTotal = 3.5;
                } elseif ($nilaiTotal >= 70) {
                    $nilaiTotal = 3;
                } elseif ($nilaiTotal >= 63) {
                    $nilaiTotal = 2.5;
                } elseif ($nilaiTotal >= 55) {
                    $nilaiTotal = 2;
                } elseif ($nilaiTotal >= 40) {
                    $nilaiTotal = 1;
                } elseif ($nilaiTotal < 40) {
                    $nilaiTotal = 0;
                }

                $sigmaNilai += $totalSKS * $nilaiTotal;
                $rataRata = $sigmaNilai / $totalSKS;
                $resultAngkaRataRata = $rataRata;
                if ($rataRata == 4) {
                    $rataRata = 'A';
                } elseif ($rataRata >= 3.5) {
                    $rataRata = 'AB';
                } elseif ($rataRata >= 3) {
                    $rataRata = 'B';
                } elseif ($rataRata >= 2.5) {
                    $rataRata = 'C+';
                } elseif ($rataRata >= 2) {
                    $rataRata = 'C';
                } elseif ($rataRata >= 1) {
                    $rataRata = 'D';
                } elseif ($rataRata < 1) {
                    $rataRata = 'E';
                }
                $resultRataRata =  $rataRata;
                $nilaiAngka = $sigmaNilai / $totalSKS;

                // IPS
                // dd($resultAngkaNilaiTotal);
                $datas[] = array(
                    'kodeMataKuliah' => $kodeMatkul,
                    'namaMataKuliah' => $namaMatkul,
                    'semester' => $semester,
                    'totalSKS' => $totalSKS,
                    'nilaiAngka' => $nilaiAngka,
                    'nilaiRataRata' => $resultRataRata,
                    'nilaiAngkaNilaiTotal' => $resultAngkaNilaiTotal,
                    'sigmaNilai' => $sigmaNilai,
                    'totalSKS' => $totalSKS,
                );
            }

            $allSKSIPS = 0;
            $poins = 0;
            $ips = 0;
            foreach ($datas as $key => $value) {
                $allSKSIPS += $value['totalSKS'];
                $poins += $value['sigmaNilai'];
            }

            if ($poins != 0 && $allSKSIPS != 0) {
                $ips = number_format($poins / $allSKSIPS, 2, '.', '');
            }

            $data = array(
                // 'sp' => $sp,
                'sakit' => $sakit,
                'izin' => $izin,
                'tidak_hadir' => $tidak_hadir,
                'terlambat' => $terlambat,
                'perwalian' => $perwalian,
                'ipk' => $ipk,
                'ips' => $ips,
                'semester' => $getSemester
            );
        }

        return view('home', $data);
    }

    public function checkKehadiran($kehadiran)
    {
        if (!Auth::guard('orang_tua')->user()) {
            $id_mahasiswa = auth()->user()->id;
        } else {
            $id_mahasiswa = Auth::guard('orang_tua')->user()->id_mahasiswa;
        }

        if ($kehadiran == 'terlambat') {
            $data['kehadiran'] = DB::table('kehadirans')
                ->selectRaw("kehadirans.*, users.name as mahasiswa, jadwals.hari, mata_kuliah_enrolls.id_mata_kuliah, mata_kuliahs.nama_mata_kuliah")
                ->join('users', 'kehadirans.id_mahasiswa', '=', 'users.id')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('mata_kuliahs', 'mata_kuliah_enrolls.id_mata_kuliah', '=', 'mata_kuliahs.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', $id_mahasiswa)
                ->where('kehadirans.terlambat', '>', 0)
                ->orderBy('kehadirans.pertemuan', 'desc')
                ->get();
        } else {
            $data['kehadiran'] = DB::table('kehadirans')
                ->selectRaw("kehadirans.*, users.name as mahasiswa, jadwals.hari, mata_kuliah_enrolls.id_mata_kuliah, mata_kuliahs.nama_mata_kuliah")
                ->join('users', 'kehadirans.id_mahasiswa', '=', 'users.id')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('mata_kuliahs', 'mata_kuliah_enrolls.id_mata_kuliah', '=', 'mata_kuliahs.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', $id_mahasiswa)
                ->where('kehadirans.status', $kehadiran)
                ->orderBy('kehadirans.pertemuan', 'desc')
                ->get();
        }

        $data['jenis_kehadiran'] = $kehadiran;

        return view('check-kehadiran.index', $data);
    }
}
