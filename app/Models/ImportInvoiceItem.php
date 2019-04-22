<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ImportInvoiceItem extends Model
{
    use SoftDeletes;

    protected $table = 'import_invoice_item';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'code',
        'name',
        'iprice',
        'quantity',
        'image'
    ];

    public function importInvoice()
    {
        return $this->belongsTo(\App\Models\ImportInvoice::class,'invoice_id','id');
    }

}
