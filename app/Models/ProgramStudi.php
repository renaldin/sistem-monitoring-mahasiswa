<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jurusan','nama_prodi'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan','id');
    }

    public function mataKuliah()
    {
        return $this->hasMany(MataKuliah::class, 'id_prodi', 'id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_prodi', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id_prodi', 'id');
    }
}
