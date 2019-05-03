<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExportInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'export_invoice';

    protected $fillable = [
        'code',
        'money_total',
        'quantity_total',
        'note',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function exportInvoiceItem()
    {
        return $this->hasMany(\App\Models\ExportInvoiceItem::class,'invoice_id','id');
    }
 }
