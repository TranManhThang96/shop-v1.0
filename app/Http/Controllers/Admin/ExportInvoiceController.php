<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\ExportInvoice\ExportInvoiceRepositoryInterface;
use App\Repositories\ExportInvoiceItem\ExportInvoiceItemRepositoryInterface;

class ExportInvoiceController extends Controller
{
    protected $exportInvoiceRepository;
    protected $exportInvoiceItemRepository;

    public function __construct(
        ExportInvoiceRepositoryInterface $exportInvoiceRepository,
        ExportInvoiceItemRepositoryInterface $exportInvoiceItemRepository
    )
    {
        $this->exportInvoiceRepository = $exportInvoiceRepository;
        $this->exportInvoiceItemRepository = $exportInvoiceItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = $this->exportInvoiceRepository->getInvoices($request);
        return view('admin.export_invoice.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.export_invoice.create');
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
            $invoice = $this->exportInvoiceRepository->store($request);
            if (!empty($invoice)) {
                if ($this->exportInvoiceItemRepository->addItem($request->items,$invoice->id)) {
                    DB::commit();
                    return redirect()->route('export-invoice.index')->with('alert-success','Thêm hóa đơn thành công');
                } else {
                    return redirect()->route('export-invoice.index')->with('alert-danger','Thêm hóa đơn thất bại');
                }

            } else {
                throw new \Exception('Không thể thêm');
            }

        } catch (Exception $e) {
            return redirect()->route('export-invoice.index')->with('alert-danger',$e->getMessage());
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
