<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = [
        'code',
        'name',
        'phone',
        'email',
        'address'
    ];

    public function importInvoice()
    {
        return $this->hasMany('App\Models\ImportInvoice','supplier_id','id');
    }
}
