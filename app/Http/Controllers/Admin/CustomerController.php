<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\District\DistrictRepositoryInterface;
use App\Repositories\Ward\WardRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\CustomerCollection;

class CustomerController extends Controller
{

    protected $customerRepository;
    protected $provinceRepository;
    protected $districtRepository;
    protected $wardRepository;


    /**
     * CustomerController constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param ProvinceRepositoryInterface $provinceRepository
     * @param DistrictRepositoryInterface $districtRepository
     * @param WardRepositoryInterface $wardRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        ProvinceRepositoryInterface $provinceRepository,
        DistrictRepositoryInterface $districtRepository,
        WardRepositoryInterface $wardRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->provinceRepository = $provinceRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = $this->customerRepository->getCustomers($request);
        $allProvinces = $this->provinceRepository->all();
        $districts = $this->districtRepository->getDistrictsByProvince($request->province_id);
        $wards = $this->wardRepository->getWardsByDistrict($request->district_id);
        return view('admin.customer.index',compact('customers','allProvinces','districts','wards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allProvinces = $this->provinceRepository->all();
        return view('admin.customer.create',compact('allProvinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->customerRepository->store($request)) {
            return Redirect()->route('customers.index')->with('alert-success','Thêm khách hàng thành công');
        }
        return Redirect()->route('customers.index')->with('alert-success','Thêm khách hàng thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new CustomerCollection(\App\Models\Customer::all()))->response()
            ->header('X-Value', 'True');;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allProvinces = $this->provinceRepository->all();
        $customer = $this->customerRepository->getCustomerById($id);
        $districts = $this->districtRepository->getDistrictsByProvince($customer->province_id);
        $wards = $this->wardRepository->getWardsByDistrict($customer->district_id);
        return view('admin.customer.edit',compact('customer','allProvinces','districts','wards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->customerRepository->update($request,$id)) {
            return Redirect()->route('customers.index')->with('alert-success','Cập nhật khách hàng thành công');
        }
        return Redirect()->route('customers.index')->with('alert-success','Cập nhật khách hàng thất bại');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->customerRepository->destroy($id)) {
            return Redirect()->route('customers.index')->with('alert-success','Xóa khách hàng thành công');
        }
        return Redirect()->route('customers.index')->with('alert-success','Xóa khách hàng thất bại');
    }

    /**
     * Check phone exist.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPhoneExist(Request $request)
    {
        if($this->customerRepository->checkExist('phone',$request->phone,$request->id)) {
            return Response()->json(true);
        }
        return Response()->json(false);

    }

    /**
     * Check email exist.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkEmailExist(Request $request)
    {
        if($this->customerRepository->checkExist('email',$request->email,$request->id)) {
            return Response()->json(true);
        }
        return Response()->json(false);
    }
}
