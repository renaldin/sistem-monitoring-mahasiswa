<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    use HasFactory;

    protected $table = 'sp';

    protected $fillable = [
        'id_user_penerima','file','id_kelas','deskripsi','user_id','jenis_sp'
    ];

    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_user_penerima', 'id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
