<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'is_active',
        'beneficiaries',
        'funds',
        'quote',
        'images',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'images' => 'array',
    ];
}
