<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductItem extends Model
{
    use SoftDeletes;

    protected $table = 'product_item';

    protected $fillable = [
        'product_id',
        'sku_item',
        'quantity',
        'price',
        'iprice',
        'discount_id',
        'length',
        'width',
        'height',
        'weight',
        'color',
        'size',
        'created_by'
    ];

    protected $timestamp = true;

    public function product()
    {
        return $this->belongsTo('App\Models\Product','id','product_id');
    }
}
