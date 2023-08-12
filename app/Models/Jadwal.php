<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = [
        'id_mata_kuliah_enroll','hari','jam_mulai','jam_selesai',
    ];

    public function mataKuliahEnroll()
    {
        return $this->belongsTo(mataKuliahEnroll::class, 'id_mata_kuliah_enroll','id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_jadwal', 'id');
    }
}
