<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Repositories\Province\ProvinceRepositoryInterface;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $provinceRepository;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        ProvinceRepositoryInterface $provinceRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->provinceRepository = $provinceRepository;
    }


    public function index(Request $request)
    {
        $orders = $this->orderRepository->getOrders($request);
        return view('admin.export_invoice.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allProvinces = $this->provinceRepository->all();
        return view('admin.order.create',compact('allProvinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = $this->orderRepository->store($request);
            if (!empty($order)) {
                if ($this->orderItemRepository->addItem($request->items,$order->id)) {
                    DB::commit();
                    return redirect()->route('orders.index')->with('alert-success','Thêm đơn hàng thành công');
                } else {
                    return redirect()->route('orders..index')->with('alert-danger','Thêm đơn hàng thất bại');
                }

            } else {
                throw new \Exception('Không thể thêm');
            }

        } catch (Exception $e) {
            return redirect()->route('orders.index')->with('alert-danger',$e->getMessage());
            DB::rollback();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
