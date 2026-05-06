<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonfirmasiDonasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'no_whatsapp',
        'tanggal_transfer',
        'program',
        'nominal',
        'bukti_pembayaran',
        'status',
    ];
}
