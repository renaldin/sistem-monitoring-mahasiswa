<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarNilai extends Model
{
    use HasFactory;

    protected $table = 'daftar_nilais';

    protected $fillable = [
        'kategori_tugas','id_tahun_ajaran','id_kelas','id_mata_kuliah','judul_kategori'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran','id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah','id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_daftar_nilai', 'id');
    }

}
