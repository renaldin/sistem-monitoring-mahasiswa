<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $fillable = [
        'id_daftar_nilai','id_mahasiswa','nilai',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }

    public function daftarNilai()
    {
        return $this->belongsTo(DaftarNilai::class, 'id_daftar_nilai', 'id');
    }
}
