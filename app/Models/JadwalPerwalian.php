<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPerwalian extends Model
{
    use HasFactory;
    protected $table = 'jadwal_perwalian';

    protected $fillable = [
        'id_dosen_wali','keterangan','id_kelas','tanggal'
    ];
}
