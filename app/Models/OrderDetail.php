<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'product_name',
        'product_code',
        'product_img',
        'product_price',
        'product_iprice'
    ];

    protected $timestamp = true;
}
