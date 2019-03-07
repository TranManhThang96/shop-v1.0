<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        $model = new Customer();
        $allProvince = Province::all();
        $keyword = '';
        $limit = 10;
        $page = isset($request->page) ? $request->page : 1;
        if (isset($request->limit)) {
            $limit = $request->limit;
        }
        $listCustomers = $model->orderBy('id', 'DESC');
        if (isset($request->keyword)) {
            $keyword = $request->keyword;
            $listCustomers = $model->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('code', 'LIKE', '%' . $keyword . '%')
                ->orWhere('phone', 'LIKE', '%' . $keyword . '%');
        }

        $dataAddress = [
            'province_id' => 0,
            'district_id' => 0,
            'ward_id' => 0,
            'allProvince' => $allProvince,
        ];
        if ($request->province_id > 0) {
            $dataAddress['province_id'] = $request->province_id;
            $dataAddress['listDistrict'] = District::where('province_id', $dataAddress['province_id'])->get();
            $listCustomers = $listCustomers->where('province_id', $dataAddress['province_id']);
        }
        if ($request->district_id > 0) {
            $dataAddress['district_id'] = $request->district_id;
            $dataAddress['listWard'] = Ward::where('district_id', $dataAddress['district_id'])->get();
            $listCustomers = $listCustomers->where('district_id', $dataAddress['district_id']);
        }
        if ($request->ward_id > 0) {
            $dataAddress['ward_id'] = $request->ward_id;
            $listCustomers = $listCustomers->where('ward_id', $dataAddress['ward_id']);
        }

        $listCustomers = $listCustomers->paginate($limit);

        if (isset($request->keyword)) {
            $listCustomers = $listCustomers->withPath("?keyword = $keyword");
        }
        $countAvailable = $listCustomers->count();

        return view('admin.customer.list', compact('listCustomers', 'keyword', 'page', 'limit', 'countAvailable', 'dataAddress'));
    }

    public function add()
    {
        $allProvince = Province::all();
        $dataAddress = [
            'allProvince' => $allProvince
        ];
        $model = new Customer();
        return view('admin.customer.form')->with(['model' => $model, 'dataAddress' => $dataAddress]);
    }

    public function edit(Request $request)
    {
        $model = Customer::find($request->id);
        $allProvince = Province::all();
        $dataAddress = [
            'allProvince' => $allProvince
        ];
        if ($model->province_id > 0) {
            $dataAddress['province_id'] = $model->province_id;
            $dataAddress['listDistrict'] = District::where('province_id', $dataAddress['province_id'])->get();
        }
        if ($model->district_id > 0) {
            $dataAddress['district_id'] = $model->district_id;
            $dataAddress['listWard'] = Ward::where('district_id', $dataAddress['district_id'])->get();
        }
        if ($model->ward_id > 0) {
            $dataAddress['ward_id'] = $model->ward_id;
        }
        return view('admin.customer.form')->with(['model' => $model, 'dataAddress' => $dataAddress]);
    }

    public function remove(Request $request)
    {
        $customerId = $request->id;
        $model = Customer::find($customerId);
        $model->delete();
        return redirect()->route('admin.customer.list');
    }

    public function save(CustomerRequest $request)
    {
        if (!isset($request->id)) {
            $model = new Customer();
            $model->code = 'KH' . time();
        } else {
            $model = Customer::find($request->id);
        }
        $model->fill($request->all());
        $model->address = $request->street . ', ' . $model->ward->name . ', ' . $model->district->name . ', ' . $model->province->name;
        $model->save();
        return redirect()->route('admin.customer.list');
    }

    public function checkPhoneExist(Request $request)
    {
        $phone = $request->phone;
        $customerId = $request->id;
        if (isset($customerId)) {
            $count = Customer::where('phone', $phone)->where('id', '<>', $customerId)->count();
        } else {
            $count = Customer::where('phone', $phone)->count();
        }
        if ($count > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }

    }

    public function checkEmailExist(Request $request)
    {
        $email = $request->email;
        $customerId = $request->id;
        if (isset($customerId)) {
            $count = Customer::where('email', $email)->where('id', '<>', $customerId)->count();
        } else {
            $count = Customer::where('email', $email)->count();
        }
        if ($count > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }

    }
}
