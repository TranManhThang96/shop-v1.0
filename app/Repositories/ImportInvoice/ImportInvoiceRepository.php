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

    /**
     * Get ImportInvoices by province.
     *
     * @param $filter
     * @return array object
     */

}