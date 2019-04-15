<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Discount\DiscountRepositoryInterface;
use App\Http\Requests\DiscountRequest;
class DiscountController extends Controller
{
    protected $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts = $this->discountRepository->getDiscounts($request->all());
        return view('admin.discount.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        if ($this->discountRepository->store($request)) {
            return redirect()->route('discounts.index')->with('alert-success', 'Thêm nhà cung cấp thành công');
        } else {
            return redirect()->route('discounts.index')->with('alert-danger', 'Không thể thêm nhà cung cấp');
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
        $discount = $this->discountRepository->getDiscountById($id);
        return view('admin.discount.edit',compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
        if ($this->discountRepository->store($request)) {
            return redirect()->route('discounts.index')->with('alert-success', 'Cập nhật thành công');
        } else {
            return redirect()->route('discounts.index')->with('alert-danger', 'Không thể cập nhật');
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
        if ($this->discountRepository->store($id)) {
            return redirect()->route('discounts.index')->with('alert-success', 'Xóa khuyến mại thành công');
        } else {
            return redirect()->route('discounts.index')->with('alert-danger', 'Không thể xóa khuyến mại');
        }
    }
}
