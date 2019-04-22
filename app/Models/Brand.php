<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use SoftDeletes;

    protected $table = 'brands';

    protected $fillable = [
        'name',
        'slug',
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
