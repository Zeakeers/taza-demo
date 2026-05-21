<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'judul', 'slug', 'kategori', 'thumbnail', 'konten',
        'show_on_home', 'is_published', 'is_editor_choice', 'tags',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'artikel');
        });

        static::creating(function ($model) {
            $model->type = 'artikel';
        });
    }
}
