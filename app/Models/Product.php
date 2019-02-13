<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    //has One
    public function category()
    {
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
}
