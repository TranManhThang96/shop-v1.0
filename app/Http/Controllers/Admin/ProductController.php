<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function list()
    {
        $keyword = '';
        return view('admin.product.list',compact('keyword'));
    }

    public function add()
    {
        return view('admin.product.form');
    }

    public function edit($id)
    {
        $model = new Product();

        $product = $model->find($id);

        return view('admin.product.form',compact('product'));
    }

    public function remove()
    {

    }

    public function save()
    {

    }
}
