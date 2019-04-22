<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content'
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = mb_strtoupper($value);
    }

}









