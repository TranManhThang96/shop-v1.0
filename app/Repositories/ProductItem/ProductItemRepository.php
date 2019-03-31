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
}