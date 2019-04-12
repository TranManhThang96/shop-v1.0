<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{

    use SoftDeletes;
    protected $table = 'categories';

    protected $fillable = ['name','slug','parent_id','active','order'];

    protected $timestamp = true;

    public function product()
    {
        return $this->hasMany('App\Models\Product','cat_id','id');
    }

}
