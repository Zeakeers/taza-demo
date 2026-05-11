<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekeningBank extends Model
{
    protected $fillable = ['rekening_category_id', 'bank_name', 'account_number', 'logo', 'order'];

    public function category()
    {
        return $this->belongsTo(RekeningCategory::class, 'rekening_category_id');
    }
}
