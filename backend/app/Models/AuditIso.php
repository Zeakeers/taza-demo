<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditIso extends Model
{
    use HasFactory;

    protected $table = 'tata_kelolas';

    protected $fillable = ['description', 'link_text', 'file'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'audit_iso');
        });

        static::creating(function ($model) {
            $model->type = 'audit_iso';
        });
    }
}
