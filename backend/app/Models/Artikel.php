<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'thumbnail',
        'konten',
        'show_on_home',
        'is_published',
        'is_editor_choice',
        'tags',
    ];
}
