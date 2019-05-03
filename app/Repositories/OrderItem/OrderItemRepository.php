<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\ExportInvoiceItem;

use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Repositories\RepositoryAbstract;
use Validator;
use DB;
use App\Models\ExportInvoiceItem;
use App\Repositories\ProductItem\ProductItemRepositoryInterface;

class ExportInvoiceItemRepository extends RepositoryAbstract implements ExportInvoiceItemRepositoryInterface
{
    protected $productItemRepository;
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(ExportInvoiceItem $exportInvoiceItem, ProductItemRepositoryInterface $productItemRepository)
    {
        parent::__construct();
        $this->model = $exportInvoiceItem;
        $this->table = 'export_invoice_item';
        $this->productItemRepository = $productItemRepository;
    }

    /**
     * Get ExportInvoiceItems by province.
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
                'price' => getAmount($items[$key]['price']),
                'image' => $items[$key]['image'],
                'quantity' => $items[$key]['quantity']
            ];
            $this->productItemRepository->updateQuantityAndPrice($items[$key]['id'], $items[$key]['quantity'], 0, '-');
        }
        return $this->model->insert($invoiceItems);
    }

}