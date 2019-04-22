<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillale = [
        'name',
        'district_id'
    ];

    protected $timestamp = false;

    public function customer()
    {
        return $this->hasMany('App\Models\Customer','ward_id','id');
    }

    public function getNameAttribute($value)
    {
        return mb_strtoupper($value);
    }
}
