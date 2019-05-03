<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ExportInvoiceItem extends Model
{
    use SoftDeletes;

    protected $table = 'export_invoice_item';

    protected $fillable = [
        'invoice_id',
        'product_item_id',
        'sku',
        'name',
        'iprice',
        'price',
        'quantity',
        'image',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function exportInvoice()
    {
        return $this->belongsTo(\App\Models\ExportInvoice::class,'invoice_id','id');
    }

    public function productItem()
    {
        return $this->belongsTo(\App\Models\ProductItem::class,'product_item_id','id');
    }
}
