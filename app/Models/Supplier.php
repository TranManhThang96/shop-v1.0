<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Supplier extends Model
{
    use SoftDeletes;

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
