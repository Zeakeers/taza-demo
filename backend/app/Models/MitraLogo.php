<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraLogo extends Model
{
    protected $fillable = ['mitra_section_id', 'name', 'logo', 'order'];

    public function section()
    {
        return $this->belongsTo(MitraSection::class, 'mitra_section_id');
    }
}
