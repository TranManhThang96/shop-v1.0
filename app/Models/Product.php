<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const PER_PAGE = 10;

    const ACTIVE = 1;

    const NOT_ACTIVE = 0;

    protected $table = 'products';

    protected $fillable = [
        'cat_id',
        'name',
        'sku',
        'price',
        'iprice',
        'barcode',
        'discount_id',
        'img_link',
        'img_list',
        'brand',
        'short_description',
        'description',
        'status',
        'created_by'
    ];

    protected $timestamp = true;

    //has One
    public function category()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function discount()
    {
        return $this->belongsTo('App\Models\Discount','discount_id','id');
    }

    public function productItem()
    {
        return $this->hasMany('App\Models\ProductItem','product_id','id');
    }

    public function image()
    {
        return $this->morphMany(\App\Models\Image::class,'imageable');
    }
}
