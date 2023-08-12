<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tahun_ajaran','nama_kelas','kode_kelas','id_dosen_wali','id_prodi','status','angkatan',
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id');
    }

    public function dosenWali()
    {
        return $this->belongsTo(User::class, 'id_dosen_wali', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi','id');
    }

    public function daftarNilai()
    {
        return $this->hasMany(DaftarNilai::class, 'id_kelas', 'id');
    }

    public function Sp()
    {
        return $this->hasMany(Sp::class, 'id_kelas', 'id');
    }

    public function kelasEnroll()
    {
        return $this->hasOne(KelasEnroll::class, 'id_kelas', 'id');
    }

    public function perwalian()
    {
        return $this->hasMany(Perwalian::class, 'id_kelas', 'id');
    }

    public function mataKuliahEnroll()
    {
        return $this->hasMany(MataKuliahEnroll::class, 'id_kelas', 'id');
    }
}
