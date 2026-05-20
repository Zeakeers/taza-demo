<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $table = 'tata_kelolas';

    protected $fillable = ['year', 'title', 'file'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'financial');
        });

        static::creating(function ($model) {
            $model->type = 'financial';
        });
    }
}
