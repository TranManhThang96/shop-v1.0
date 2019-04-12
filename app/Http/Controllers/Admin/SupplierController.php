<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Repositories\Supplier\SupplierRepositoryInterface;
class SupplierController extends Controller
{

    protected $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = $this->supplierRepository->getSuppliers($request->all());
        return view('admin.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        if ($this->supplierRepository->store($request)) {
            return redirect()->route('suppliers.index')->with('alert-success', 'Thêm nhà cung cấp thành công');
        } else {
            return redirect()->route('suppliers.index')->with('alert-danger', 'Không thể thêm nhà cung cấp');
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
        $supplier = $this->supplierRepository->getSupplierById($id);
        return view('admin.supplier.edit',compact('supplier'));
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
        if ($this->supplierRepository->update($request,$id)) {
            return redirect()->route('suppliers.index')->with('alert-success', 'Sửa nhà cung cấp thành công');
        } else {
            return redirect()->route('suppliers.index')->with('alert-danger', 'Không thể sửa nhà cung cấp');
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
        if ($this->supplierRepository->destroy($id)) {
            return redirect()->route('suppliers.index')->with('alert-success', 'Xóa nhà cung cấp thành công');
        } else {
            return redirect()->route('suppliers.index')->with('alert-danger', 'Không thể xóa nhà cung cấp');
        }
    }

    /**
     * Check exist supplier.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkExist(Request $request)
    {
        if ($this->supplierRepository->checkExist($request->type,$request->value,$request->supplierId)) {
            return Response()->json(true);
        }
        return Response()->json(false);
    }
}
