<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    protected $table = 'product_item';

    protected $fillable = [
        'product_id',
        'quantity',
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
