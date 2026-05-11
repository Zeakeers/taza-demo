<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekeningCategory extends Model
{
    protected $fillable = ['name', 'order'];

    public function banks()
    {
        return $this->hasMany(RekeningBank::class, 'rekening_category_id')->orderBy('order');
    }
}
