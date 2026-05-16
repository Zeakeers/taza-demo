<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraSection extends Model
{
    protected $fillable = ['name', 'order'];

    public function logos()
    {
        return $this->hasMany(MitraLogo::class, 'mitra_section_id')->orderBy('order');
    }
}
