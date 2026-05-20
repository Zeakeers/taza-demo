<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalFormal extends Model
{
    use HasFactory;

    protected $table = 'tata_kelolas';

    protected $fillable = ['title', 'elements'];

    protected $casts = [
        'elements' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'legal_formal');
        });

        static::creating(function ($model) {
            $model->type = 'legal_formal';
        });
    }
}
