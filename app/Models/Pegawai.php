<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'no_telepon',
        'email',
        'alamat',
        'tanggal_bergabung',
        'jabatan',
        'gaji',
        'foto',
    ];
}
