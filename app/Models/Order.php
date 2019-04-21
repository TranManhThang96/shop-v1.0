<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'code',
        'customer_id',
        'customer_name',
        'customer_phone',
        'address',
        'detail',
        'payment_method',
        'status',
        'note',
        'reason',
        'product_qty',
        'customer_fee',
        'revenue',
        'ship_fee',
        'cod_fee',
        'voucher',
        'voucher_code',
        'province',
        'district',
        'created_by'
    ];

    protected $timestamp = true;

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','id','customer_id');
    }

    public function discount()
    {
        return $this->belongsTo('App\Models\Discount','id','discount_id');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province','id','province_id');
    }

    public function product()
    {
        return $this->belongsToMany('App\Models\Product','order_detail','order_id','product_id')
            ->withPivot('quantity');
    }

}
