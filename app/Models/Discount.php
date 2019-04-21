<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use SoftDeletes;

    protected $table = 'discounts';

    const TYPE_BY_PRODUCT = 1;

    const TYPE_BY_ORDER = 2;

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
