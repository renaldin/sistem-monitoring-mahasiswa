<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'identity_number', 'id_role', 'password', 'address', 'phone_number',
        'gender', 'id_prodi', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(ProgramStudi::class, 'id_prodi', 'id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'id_mahasiswa', 'id');
    }

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'id_dosen_wali', 'id');
    }

    public function kelasEnroll()
    {
        return $this->hasMany(KelasEnroll::class, 'id_mahasiswa', 'id');
    }

    public function mahasiswaMataKuliahEnroll()
    {
        return $this->hasOne(MahasiswaMataKuliahEnroll::class, 'id_mahasiswa', 'id');
    }

    public function mataKuliahEnroll()
    {
        return $this->hasMany(MataKuliahEnroll::class, 'id_dosen', 'id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mahasiswa', 'id');
    }

    public function perwalian()
    {
        return $this->hasOne(Perwalian::class, 'id_mahasiswa', 'id');
    }

    public function sp()
    {
        return $this->hasMany(Sp::class, 'id_user_penerima', 'id');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'id_mahasiswa', 'id');
    }
}
