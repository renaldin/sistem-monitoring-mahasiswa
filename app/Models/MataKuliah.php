<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'nama_mata_kuliah','id_prodi','kode_mata_kuliah','sks','status','semester'
    ];

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id');
    }

    public function daftarNilai()
    {
        return $this->hasMany(DaftarNilai::class, 'id_mata_kuliah','id');
    }

    public function mataKuliahEnroll()
    {
        return $this->hasMany(MataKuliahEnroll::class, 'id_mata_kuliah', 'id');
    }
}
