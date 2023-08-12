<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasEnroll extends Model
{
    use HasFactory;

    protected $table = 'kelas_enrolls';

    protected $fillable = [
        'id_mahasiswa','id_kelas',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas','id');
    }

}
