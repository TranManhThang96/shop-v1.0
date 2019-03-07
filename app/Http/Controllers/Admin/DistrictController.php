<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;

class DistrictController extends Controller
{
    public function getListDistrictByProvince(Request $request)
    {
        $model = new District();
        $provinceId = $request->provinceId;
        $data = $model->where('province_id',$provinceId)->get();
        if(!empty($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json($data,404);
        }
    }
}
