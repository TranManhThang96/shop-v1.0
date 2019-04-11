<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'code',
        'name',
        'email',
        'sex',
        'age',
        'user_name',
        'password',
        'phone',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'street',
        'created_by'
    ];

    protected $timestamp = true;

    public function order()
    {
        return $this->hasMany('App\Models\Order','customer_id','id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province','province_id','id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District','district_id','id');
    }

    public function ward()
    {
        return $this->belongsTo('App\Models\Ward','ward_id','id');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image','imageable');
    }
}
