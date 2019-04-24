<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\ImportInvoice;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\ImportInvoice;
use Illuminate\Support\Str;

class ImportInvoiceRepository extends RepositoryAbstract implements ImportInvoiceRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(ImportInvoice $importInvoice)
    {
        parent::__construct();
        $this->model = $importInvoice;
        $this->table = 'import_invoice';
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
     * Get ImportInvoices by province.
     *
     * @param $filter
     * @return array object
     */

    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->code = 'NK'.time();
        if (!empty($this->model->creted_at)) {
            $this->model->creted_at = formatDate("Y-m-d H:i:s", $this->model->creted_at, "d/m/Y");
        } else {
            $this->model->created_at = date('Y-m-d H:i:s');
        }
        if ($this->model->save()) {
            return $this->model;
        }
        return null;
    }



}