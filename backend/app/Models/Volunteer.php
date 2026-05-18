<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'kontribusi',
        'keterangan',
        'status',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];
}
