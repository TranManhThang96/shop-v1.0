<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderDetail extends Model
{
    use SoftDeletes;

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
