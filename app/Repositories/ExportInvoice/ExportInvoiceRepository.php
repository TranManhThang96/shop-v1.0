<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\ExportInvoice;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\ExportInvoice;
use Illuminate\Support\Str;

class ExportInvoiceRepository extends RepositoryAbstract implements ExportInvoiceRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(ExportInvoice $exportInvoice)
    {
        parent::__construct();
        $this->model = $exportInvoice;
        $this->table = 'export_invoice';
    }

    public function getInvoices($request)
    {
        $invoices = $this->model->orderBy('id', 'desc');

        if (!empty($request->search)) {
            $invoices = $invoices->where('code', 'LIKE', '%' . $request->search . '%');
        }

        $per = isset($request['per']) ? $request['per'] : 10;
        return $invoices->paginate($per)->appends($request->all());
    }

    /**
     * Get ExportInvoices by province.
     *
     * @param $filter
     * @return array object
     */

    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->code = 'XK'.time();
        if (!empty($this->model->creted_at)) {
            $this->model->creted_at = formatDate($this->model->creted_at, "d/m/Y", "Y-m-d H:i:s");
        } else {
            $this->model->created_at = date('Y-m-d H:i:s');
        }
        if ($this->model->save()) {
            return $this->model;
        }
        return null;
    }



}