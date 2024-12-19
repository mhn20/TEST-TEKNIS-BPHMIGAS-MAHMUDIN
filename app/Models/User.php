<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'timestamp',
        'password',
        'avatar',
        'remember_token',
        'is_admin',
        'document',
        'longtext',
        'keyverif',
        'longtext',
        'status',
        'isverif',
        'nama_lengkap',
        'alias',
        'nik',
        'dokumen_ktp',
        'alamat',
        'telp',
        'isnpwp',
        'npwp',
        'dokumen_npwp',
        'nama_rek',
        'keyforgotpassword',
        'pragita_composer_id',
        'no_kontrak',
        'hari',
        'tanggal',
        'tempat',
        'bulan',
        'tahun',
        'namabank',
        'cabang',
        'pemilik',
        'tujuan',
        'isverifadmin', 'keterangan', 
        'keyforgotpassword', 'name', 'negara', 'kota', 'kecamatan', 'kelurahan', 'alamat', 'level'
    ];

}
