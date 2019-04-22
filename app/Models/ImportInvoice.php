<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ImportInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'import_invoice';

    protected $fillable = [
        'code',
        'supplier_id',
        'money_total',
        'quantity_total',
        'note',
        'created_by',
        'updated_by'
    ];

    public function supplier()
    {
        return $this->hasOne(\App\Models\Supplier::class,'supplier_id','id');
    }

    public function importInvoiceItem()
    {
        return $this->hasMany(\App\Models\ImportInvoiceItem::class,'invoice_id','id');
    }
}
