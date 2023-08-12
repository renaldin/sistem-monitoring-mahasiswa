<?php

use Illuminate\Support\Facades\Auth;

if(!function_exists('check_late')) {
    function check_late() {
        $id_mahasiswa = 0;

        if(Auth::guard('web')->user()){
            $id_mahasiswa = auth()->user()->id;
        } elseif(Auth::guard('orang_tua')->user()) {
            $id_mahasiswa = Auth::guard('orang_tua')->user()->id_mahasiswa;
        }

        $late = DB::table('kehadirans')
                ->join('jadwals', 'kehadirans.id_jadwal', '=', 'jadwals.id')
                ->join('mata_kuliah_enrolls', 'jadwals.id_mata_kuliah_enroll', '=', 'mata_kuliah_enrolls.id')
                ->join('kelas', 'mata_kuliah_enrolls.id_kelas', '=', 'kelas.id')
                ->where('kelas.status', '=', 'aktif')
                ->where('kehadirans.id_mahasiswa', '=', $id_mahasiswa)
                ->sum('kehadirans.terlambat');

        return $late;
    }
}