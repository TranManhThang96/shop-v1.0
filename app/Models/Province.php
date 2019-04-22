<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    protected $fillable = ['name'];

    protected $timestamp = false;

    public function customer()
    {
        return $this->hasMany('App\Models\Customer','province_id','id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order','province_id','id');
    }

    public function getNameAttribute()
    {
        return mb_strtoupper($this->attributes['name']);
    }
}
