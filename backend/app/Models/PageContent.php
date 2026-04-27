<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $guarded = [];

    protected $casts = [
        'content' => 'json',
    ];
}
