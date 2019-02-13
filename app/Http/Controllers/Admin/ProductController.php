<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function getNameCategory()
    {
        $model = new Product();
        echo $model->first()->category->name;
    }
}
