<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = ['name','alias','parent_id','active','order'];

    protected $timestamp = true;

    public function product()
    {
        return $this->hasMany('App\Models\Product','cat_id','id');
    }

}
