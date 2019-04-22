<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\ProductItem;

use App\Repositories\RepositoryAbstract;
use App\Models\ProductItem;
use Illuminate\Support\Arr;

class ProductItemRepository extends RepositoryAbstract implements ProductItemRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(ProductItem $productItem)
    {
        parent::__construct();
        $this->model = $productItem;
        $this->table = 'product_item';
    }

    /**
     * Get list product set.
     *
     * @param $filter
     * @return array object
     */
    public function getProductItemsByProductId($id)
    {
        $productItems = $this->model->where('product_id', $id)->get();
        return $productItems;
    }

    /**
     * get a product set by id.
     * @param $id
     * @return object
     */
    public function getProductById($id)
    {
        return $this->model->find($id);
    }

    /**
     * destroy relationship product set.
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $product = $this->model->find($id);
        $product->set_product_id = null;
        $product->note = '';
        if ($product->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function addItem($items, $productId, $productCode)
    {
        foreach ($items as $key => $item) {
            $items[$key]['product_id'] = $productId;
            $items[$key]['sku_item'] = $productCode . '-' . $key;
            $items[$key]['price'] = getAmount($items[$key]['price']);
            $items[$key]['iprice'] = getAmount($items[$key]['iprice']);
            $items[$key]['created_at'] = date('Y-m-d H:i:s');
        }
        return $this->model->insert($items);

    }

    public function updateItem($items, $productId, $productCode)
    {
        $ids = [];
        $ids_update = [];
        $last_key = 0;
        $item_list = $this->model->where('product_id', $productId)->orderBy('id', 'DESC')->get();
        if (!empty($item_list)) {
            $ids = $item_list->pluck('id')->toArray();
            $sku_item = $item_list->pluck('sku_item')->toArray()[0];
            $pos = strpos($sku_item, '-');
            $last_key = (int)substr($sku_item, $pos + 1);
        }

        foreach ($items as $key => $item) {
            if (!empty($item['id'])) {
                $items[$key]['price'] = getAmount($item['price']);
                $items[$key]['iprice'] = getAmount($item['iprice']);
                $items[$key]['updated_at'] = date('Y-m-d H:i:s');
                $this->model->where('id', $item['id'])->update($items[$key]);
                $ids_update[] = $item['id'];
            } else {
                $items[$key]['product_id'] = $productId;
                $items[$key]['sku_item'] = $productCode . '-' . ($last_key + $key);
                $items[$key]['price'] = getAmount($item['price']);
                $items[$key]['iprice'] = getAmount($item['iprice']);
                $items[$key]['created_at'] = date('Y-m-d H:i:s');
                $this->model->insert($items[$key]);
            }
        }

        //xoa phan tu bi xoa
        if (count(array_diff($ids, $ids_update))) {
            $this->model->whereIn('id', array_diff($ids, $ids_update))->delete();
        }
        return true;
    }
}