<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\ImportInvoice\ImportInvoiceRepositoryInterface;
use App\Repositories\ImportInvoiceItem\ImportInvoiceItemRepositoryInterface;
use App\Repositories\Supplier\SupplierRepositoryInterface;

class ImportInvoiceController extends Controller
{
    protected $importInvoiceRepository;
    protected $supplierRepository;
    protected $importInvoiceItemRepository;

    public function __construct(
        ImportInvoiceRepositoryInterface $importInvoiceRepository,
        SupplierRepositoryInterface $supplierRepository,
        ImportInvoiceItemRepositoryInterface $importInvoiceItemRepository
    )
    {
        $this->importInvoiceRepository = $importInvoiceRepository;
        $this->supplierRepository = $supplierRepository;
        $this->importInvoiceItemRepository = $importInvoiceItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoices = $this->importInvoiceRepository->getInvoices($request);
        return view('admin.import_invoice.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = $this->supplierRepository->getAllSuppliers();
        return view('admin.import_invoice.create',compact('suppliers'));
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
            $invoice = $this->importInvoiceRepository->store($request);
            if (!empty($invoice)) {
                if ($this->importInvoiceItemRepository->addItem($request->items,$invoice->id)) {
                    DB::commit();
                    return redirect()->route('import-invoice.index')->with('alert-success','Thêm hóa đơn thành công');
                } else {
                    return redirect()->route('import-invoice.index')->with('alert-danger','Thêm hóa đơn thất bại');
                }

            } else {
                throw new \Exception('Không thể thêm');
            }

        } catch (Exception $e) {
            return redirect()->route('import-invoice.index')->with('alert-danger',$e->getMessage());
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
