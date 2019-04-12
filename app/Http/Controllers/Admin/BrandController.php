<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Brand\BrandRepositoryInterface;
use Nexmo\Response;

class BrandController extends Controller
{

    protected $repository;


    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = $this->repository->getBrands($request->all());
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->repository->store($request)) {
            return redirect(route('brands.index'))->with('alert-success', 'Thêm thương hiệu thành công');
        } else {
            return redirect(route('brands.index'))->with('alert-success', 'Thêm thương hiệu không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->repository->getBrandById($id);
        return view('admin.brand.edit',compact('brand'));
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
        if($this->repository->update($request,$id)) {
            return redirect(route('brands.index'))->with('alert-success', 'Sửa thương hiệu thành công');
        } else {
            return redirect(route('brands.index'))->with('alert-success', 'Sửa thương hiệu không thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->repository->destroy($id)) {
            return redirect(route('brands.index'))->with('alert-success', 'Xóa thương hiệu thành công');
        };
    }

    public function checkExist(Request $request)
    {
        if($this->repository->checkExist($request->name,$request->id)) {
            return Response()->json(true);
        }
        return Response()->json(false);
    }
}
