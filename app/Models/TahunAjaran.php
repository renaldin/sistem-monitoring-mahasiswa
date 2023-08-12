<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun','semester'
    ];

    public function daftarNilai()
    {
        return $this->hasMany(DaftarNilai::class, 'id_tahun_ajaran', 'id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_tahun_ajaran', 'id');
    }
}
