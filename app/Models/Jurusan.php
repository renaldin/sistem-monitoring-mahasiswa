<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jurusan'
    ];

    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class, 'id_jurusan', 'id');
    }
}
