<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliahEnroll extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah_enrolls';

    protected $fillable = [
        'id_kelas', 'id_mata_kuliah', 'id_dosen', 'status_dosen'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'id_dosen', 'id');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id_mata_kuliah_enroll', 'id');
    }

    public function mahasiswaMataKuliahEnroll()
    {
        return $this->hasMany(MahasiswaMataKuliahEnroll::class, 'id_mata_kuliah_enroll', 'id');
    }
}
