<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrangTua extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'orang_tua';

    protected $fillable = [
        'id_mahasiswa','name', 'email','nim_mahasiswa','password','address','phone_number',
        'gender',
    ];

    protected $hidden = [
        'password'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }
}
