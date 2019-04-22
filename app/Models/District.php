<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id'
    ];

    protected $timestamp = false;

    public function customer()
    {
        return $this->hasMany('App\Models\Customer','district_id','id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order','district_id','id');
    }

    public function getNameAttribute($value)
    {
        return mb_strtoupper($value);
    }
}
