<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'code',
        'type',
        'type_by',
        'discount',
        'limit',
        'created_by',
        'start',
        'end',
        'description'
    ];

    protected $timestamp = true;

    public function order()
    {
        return $this->hasMany('App\Models\Order','discount_id','id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product','discount_id','id');
    }
}
