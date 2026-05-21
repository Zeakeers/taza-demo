<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'judul', 'slug', 'kategori', 'thumbnail', 'konten',
        'show_on_home', 'is_published', 'is_popular', 'tags',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function ($builder) {
            $builder->where('type', 'berita');
        });

        static::creating(function ($model) {
            $model->type = 'berita';
        });
    }
}
