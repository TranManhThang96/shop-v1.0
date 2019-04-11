<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportInvoice extends Model
{
    protected $table = 'import_invoice';
    protected $fillable = [
        'code',
        'supplier_id',
        'money_total',
        'quantity_total',
        'note'
    ];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','supplier_id','id');
    }
}
