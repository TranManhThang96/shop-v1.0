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

    protected $appends = ['name'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] = $this->product->name.' , màu '.$this->color.' ,size '.$this->size;
    }
}
