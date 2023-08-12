<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadirans';

    protected $fillable = [
        'id_jadwal','id_mahasiswa','tanggal','status','pertemuan','jam_masuk_mahasiswa','deskripsi',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }

    public function getTanggal()
    {
        return Carbon::parse($this->attributes['tanggal'])
        ->translatedFormat('d F Y');
    }

    public function getHari()
    {
        return Carbon::parse($this->attributes['tanggal'])
        ->translatedFormat('l');
    }

    public function getJamMasukMahasiswa()
    {
        return Carbon::parse($this->attributes['jam_masuk_mahasiswa'])
        ->translatedFormat('H i');
    }
}
