<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ward;

class WardController extends Controller
{
    public function getListWardByDistrict(Request $request)
    {
        $model = new Ward();
        $districtId = $request->districtId;
        $data = $model->where('district_id',$districtId)->get();
        if(!empty($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json($data,404);
        }
    }
}
