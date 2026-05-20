<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    use HasFactory;

    protected $table = 'tata_kelolas';

    protected $fillable = ['year', 'title', 'description', 'image', 'image2', 'image3', 'file'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'annual');
        });

        static::creating(function ($model) {
            $model->type = 'annual';
        });
    }
}
