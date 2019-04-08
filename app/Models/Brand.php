<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'name',
        'image',
        'content',
        'created_by',
        'updated_by'
    ];

    protected $timestamp = true;

    public function product()
    {
        return $this->hasMany('App\Models\Product','brand_id','id');
    }
}
