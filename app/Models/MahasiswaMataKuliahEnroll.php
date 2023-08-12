<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMataKuliahEnroll extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_mata_kuliah_enrolls';

    protected $fillable = [
        'id_mata_kuliah_enroll','id_mahasiswa',
    ];

    public function MataKuliahEnroll()
    {
        return $this->belongsTo(MataKuliahEnroll::class, 'id_mata_kuliah_enroll', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }
}
