<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function list(Request $request)
    {
        $request->flash();
        $model = new Discount();
        $keyword = '';
        $limit = 10;
        $page = isset($request->page) ? $request->page : 1;
        if (isset($request->limit)) {
            $limit = $request->limit;
        }
        $listDiscount = $model->orderBy('id', 'DESC');
        //tim kiem theo tu khoa
        if ($request->keyword != '') {
            $keyword = $request->keyword;
            $listDiscount = $listDiscount->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('code', 'LIKE', '%' . $keyword . '%');
        }
        //tim kiem theo loai khuyen mai
        if ($request->typeBy != 0) {
            $listDiscount = $listDiscount->where('type_by', $request->typeBy);
        }

        //tim kiem theo thoi gian bat dau
        if($request->start != '') {
            $startTemp = \DateTime::createFromFormat('d/m/Y',$request->start);
            $listDiscount = $listDiscount->where('start', '>=',$startTemp->format('Y-m-d 00:00:00'));
        }

        //tim kiem theo thoi gian ket thuc
        if($request->end != '') {
            $startTemp = \DateTime::createFromFormat('d/m/Y',$request->end);
            $listDiscount = $listDiscount->where('end', '<=',$startTemp->format('Y-m-d 00:00:00'));
        }

        //phan trang
        $listDiscount = $listDiscount->paginate($limit);

        //url kem key
        if ($request->keyword != '') {
            $listDiscount = $listDiscount->withPath("?keyword = $request->keyword");
        }
        $countAvailable = $listDiscount->count();
        return view('admin.discount.list', compact('listDiscount', 'page', 'limit', 'countAvailable'));
    }

    public function add()
    {
        $model = new Discount();
        return view('admin.discount.form', compact('model'));
    }

    public function edit(Request $request)
    {
        $model = Discount::find($request->id);
        return view('admin.discount.form', compact('model'));

    }

    public function remove(Request $request)
    {
        $model = Discount::find($request->id);
        $model->delete();
        return redirect()->route('admin.discount.list');
    }

    public function save(Request $request)
    {
        if (!isset($request->id)) {
            $model = new Discount();
            $model->code = 'KM' . time();
        } else {
            $model = Discount::find($request->id);
        }
        $model->fill($request->all());
        $start = \DateTime::createFromFormat("d/m/Y", $request->start);
        $model->start = $start->format('Y-m-d 00:00:00');
        $end = \DateTime::createFromFormat("d/m/Y", $request->end);
        $model->end = $end->format('Y-m-d 00:00:00');
        $model->discount = str_replace('.', '', $model->discount);
        $model->limit = str_replace('.', '', $model->limit);
        $model->save();
        return redirect()->route('admin.discount.list');
    }

}
