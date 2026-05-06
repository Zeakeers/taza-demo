<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanBantuan extends Model
{
    protected $fillable = [
        'nama_pemohon',
        'alamat_domisili',
        'no_whatsapp',
        'email',
        'jenis_pemohon',
        'sumber_info',
        'referensi',
        'pernah_mengajukan',
        'waktu_terakhir_mengajukan',
        'foto_ktp',
        'deskripsi',
        'nominal',
        'status',
    ];
}
