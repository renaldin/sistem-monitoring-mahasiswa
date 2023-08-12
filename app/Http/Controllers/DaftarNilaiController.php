<?php

namespace App\Http\Controllers;

use App\Models\DaftarNilai;
use App\Models\MahasiswaMataKuliahEnroll;
use App\Models\Nilai;
use App\Models\KelasEnroll;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DaftarNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('orang_tua')->user()){
            $daftarNilai = DaftarNilai::with('mataKuliah','kelas','nilai','tahunAjaran')
            ->whereHas('nilai',function($query){
                $query->where('id_mahasiswa',Auth::guard('orang_tua')->user()->id_mahasiswa);
            })
            ->latest()
            ->get()
            ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);

        }else{
            $daftarNilai = DaftarNilai::with('mataKuliah','kelas','nilai','tahunAjaran')
            ->whereHas('nilai',function($query){
                $query->where('id_mahasiswa',Auth::user()->id);
            })
            ->latest()
            ->get()
            ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);
        }
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
                $allData = $ungroupedData->where('id_mata_kuliah',$firstData->mataKuliah->id)->where('id_kelas',$firstData->kelas->id);
                $semester = $firstData->tahunAjaran->semester;
                $totalSKS = $firstData->mataKuliah->sks;

                if(!empty($nilai['UTS'])){
                    foreach ($allData->where('kategori_tugas','UTS') as $index => $uts) {
                        if(count($uts->nilai) > 0){
                            $nilaiuts += $uts->nilai[0]->nilai;
                        }else{
                            $nilaiuts += 0;
                        }
                    }
                }
                if(!empty($nilai['UAS'])){
                    foreach ($allData->where('kategori_tugas','UAS') as $index => $uas) {
                        if(count($uas->nilai) > 0){
                            $nilaiuas += $uas->nilai[0]->nilai;
                        }else{
                            $nilaiuas += 0;
                        }
                    }
                }
                if(!empty($nilai['nilai lain lain'])){
                    foreach ($allData->where('kategori_tugas','nilai lain lain') as $index => $tugas) {
                        if(count($tugas->nilai) > 0){
                            $nilaitugas += $tugas->nilai[0]->nilai;
                        }else{
                            $nilaitugas += 0;
                        }
                    }
                    // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                }
                $nilaiTotal = $nilaitugas*0.3 + $nilaiuts*0.3 + $nilaiuas*0.4;
                $resultAngkaNilaiTotal = $nilaiTotal;
                if($nilaiTotal >= 85){
                    $nilaiTotal = 4;
                }elseif($nilaiTotal >= 78){
                    $nilaiTotal = 3.5;
                }elseif($nilaiTotal >= 70){
                    $nilaiTotal = 3;
                }elseif($nilaiTotal >= 63){
                    $nilaiTotal = 2.5;
                }elseif($nilaiTotal >= 55){
                    $nilaiTotal = 2;
                }elseif($nilaiTotal >= 40){
                    $nilaiTotal = 1;
                }elseif($nilaiTotal < 40){
                    $nilaiTotal = 0;
                }
                
                $sigmaNilai += $totalSKS * $nilaiTotal;
                $rataRata = $sigmaNilai / $totalSKS;
                $resultAngkaRataRata = $rataRata;
                if($rataRata == 4){
                    $rataRata = 'A';
                }elseif($rataRata >= 3.5){
                    $rataRata = 'AB';
                }elseif($rataRata >= 3){
                    $rataRata = 'B';
                }elseif($rataRata >= 2.5){
                    $rataRata = 'BC';
                }elseif($rataRata >= 2){
                    $rataRata = 'C';
                }elseif($rataRata >= 1){
                    $rataRata = 'D';
                }elseif($rataRata < 1){
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
            $ips = 0;
            foreach ($data as $key => $value) {
                $allSKS += $value['totalSKS'];
                $poin += $value['sigmaNilai'];
            }
            
            if($poin != 0 && $allSKS != 0){
                $ips = number_format($poin / $allSKS, 2, '.', '');
            }

            
            if(Auth::guard('orang_tua')->user()){
                $mahasiswa = User::findorFail(Auth::guard('orang_tua')->user()->id_mahasiswa);
            }else{
                $mahasiswa = User::findorFail(auth()->user()->id);
            }
            $value = array(
                'data' => $data,
                'mahasiswa' => $mahasiswa,
                'ips' => $ips,
            );
        return view('daftar_nilai.index', $value);
    }

    public function indexSemester(Request $request)
    {
        $semester = '1';
        if(!empty($request->semester)){
            $semester = $request->semester;
        }
        if(Auth::guard('orang_tua')->user()){
            $daftarNilai = DaftarNilai::with('mataKuliah','kelas','nilai','tahunAjaran')
            ->whereHas('nilai',function($query){
                $query->where('id_mahasiswa',Auth::guard('orang_tua')->user()->id_mahasiswa);
            })
            ->whereHas('tahunAjaran',function($query) use ($semester){
                $query->where('semester',$semester);
            })
            ->latest()
            ->get()
            ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);

        }else{
            $daftarNilai = DaftarNilai::with('mataKuliah','kelas','nilai','tahunAjaran')
            ->whereHas('nilai',function($query){
                $query->where('id_mahasiswa',Auth::user()->id);
            })
            ->whereHas('tahunAjaran',function($query) use ($semester){
                $query->where('semester',$semester);
            })
            ->latest()
            ->get()
            ->groupBy(['mataKuliah.nama_mata_kuliah', 'kategori_tugas']);
        }
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
                $allData = $ungroupedData->where('id_mata_kuliah',$firstData->mataKuliah->id)->where('id_kelas',$firstData->kelas->id);
                $semester = $firstData->tahunAjaran->semester;
                $totalSKS = $firstData->mataKuliah->sks;

                if(!empty($nilai['UTS'])){
                    foreach ($allData->where('kategori_tugas','UTS') as $index => $uts) {
                        if(count($uts->nilai) > 0){
                            $nilaiuts += $uts->nilai[0]->nilai;
                        }else{
                            $nilaiuts += 0;
                        }
                    }
                }
                if(!empty($nilai['UAS'])){
                    foreach ($allData->where('kategori_tugas','UAS') as $index => $uas) {
                        if(count($uas->nilai) > 0){
                            $nilaiuas += $uas->nilai[0]->nilai;
                        }else{
                            $nilaiuas += 0;
                        }
                    }
                }
                if(!empty($nilai['nilai lain lain'])){
                    foreach ($allData->where('kategori_tugas','nilai lain lain') as $index => $tugas) {
                        if(count($tugas->nilai) > 0){
                            $nilaitugas += $tugas->nilai[0]->nilai;
                        }else{
                            $nilaitugas += 0;
                        }
                    }
                    // $nilaitugas = $nilaitugas / count($nilai['tugas/kuis']);
                }
                $nilaiTotal = $nilaitugas*0.3 + $nilaiuts*0.3 + $nilaiuas*0.4;
                $resultAngkaNilaiTotal = number_format($nilaiTotal, 2, '.', '');;
                if($nilaiTotal >= 85){
                    $nilaiTotal = 4;
                }elseif($nilaiTotal >= 78){
                    $nilaiTotal = 3.5;
                }elseif($nilaiTotal >= 70){
                    $nilaiTotal = 3;
                }elseif($nilaiTotal >= 63){
                    $nilaiTotal = 2.5;
                }elseif($nilaiTotal >= 55){
                    $nilaiTotal = 2;
                }elseif($nilaiTotal >= 40){
                    $nilaiTotal = 1;
                }elseif($nilaiTotal < 40){
                    $nilaiTotal = 0;
                }
                
                $sigmaNilai += $totalSKS * $nilaiTotal;
                $rataRata = $sigmaNilai / $totalSKS;
                $resultAngkaRataRata = $rataRata;
                if($rataRata == 4){
                    $rataRata = 'A';
                }elseif($rataRata >= 3.5){
                    $rataRata = 'AB';
                }elseif($rataRata >= 3){
                    $rataRata = 'B';
                }elseif($rataRata >= 2.5){
                    $rataRata = 'C+';
                }elseif($rataRata >= 2){
                    $rataRata = 'C';
                }elseif($rataRata >= 1){
                    $rataRata = 'D';
                }elseif($rataRata < 1){
                    $rataRata = 'E';
                }
                $resultRataRata =  $rataRata;
                $nilaiAngka = $sigmaNilai / $totalSKS;

                $data[] = array(
                    'kodeMataKuliah' => $kodeMatkul,
                    'namaMataKuliah' => $namaMatkul,
                    'semester' => $semester,
                    'nilaiAngka' => $nilaiAngka,
                    'nilaiRataRata' => $resultRataRata,
                    'nilaiAngkaRataRata' => $resultAngkaRataRata,
                    'nilaiAngkaNilaiTotal' => $resultAngkaNilaiTotal,
                    'sigmaNilai' => $sigmaNilai,
                    'totalSKS' => $totalSKS,
                );
            }

            // IPS
            $allSKS = 0;
            $poin = 0;
            $ips = 0;
            foreach ($data as $key => $value) {
                $allSKS += $value['totalSKS'];
                $poin += $value['sigmaNilai'];
            }
            
            if($poin != 0 && $allSKS != 0){
                $ips = number_format($poin / $allSKS, 2, '.', '');
            }
            
            if(Auth::guard('orang_tua')->user()){
                $mahasiswa = User::findorFail(Auth::guard('orang_tua')->user()->id_mahasiswa);
            }else{
                $mahasiswa = User::findorFail(auth()->user()->id);
            }
            $value = array(
                'data' => $data,
                'mahasiswa' => $mahasiswa,
                'ips' => $ips,
            );
        
        if(empty($request->semester)){
            return view('daftar_nilai.index', $value);
        }else{
            return response()->json($value);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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