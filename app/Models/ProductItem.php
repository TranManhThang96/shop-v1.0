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
        'name',
        'sku_item',
        'quantity',
        'price',
        'iprice',
        'discount_id',
        'color',
        'size',
        'ram',
        'rom',
        'created_by'
    ];

    protected $timestamp = true;

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
