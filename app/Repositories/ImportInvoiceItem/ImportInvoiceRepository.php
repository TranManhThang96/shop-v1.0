<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\ImportInvoiceItem;

use App\Repositories\RepositoryAbstract;
use Validator;
use DB;
use App\Models\ImportInvoiceItem;

class ImportInvoiceItemRepository extends RepositoryAbstract implements ImportInvoiceItemRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(ImportInvoiceItem $ImportInvoiceItem)
    {
        parent::__construct();
        $this->model = $ImportInvoiceItem;
        $this->table = 'import_invoice_item';
    }

    /**
     * Get ImportInvoiceItems by province.
     *
     * @param $filter
     * @return array object
     */

    public function addItem($items, $invoiceId)
    {
        $invoiceItems = [];
        foreach ($items as $key => $item) {
            $invoiceItems[] = [
                'invoice_id' => $invoiceId,
                'product_item_id' => $items[$key]['id'],
                'sku' => $items[$key]['sku'],
                'name' => $items[$key]['name'],
                'iprice' => getAmount($items[$key]['iprice']),
                'image' => $items[$key]['image'],
                'quantity' => $items[$key]['quantity']
            ];
        }
        return $this->model->insert($invoiceItems);
    }

}