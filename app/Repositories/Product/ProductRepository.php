<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Product;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use File;
use Validator;
use DB;
use App\Models\Product;

class ProductRepository extends RepositoryAbstract implements ProductRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        parent::__construct();
        $this->model = $product;
        $this->table = 'products';
    }

    /**
     * Get list product set.
     *
     * @param $filter
     * @return array object
     */
    public function getProductByRequest($request)
    {
        $products = $this->model->orderBy('id', 'desc');

        if (!empty($request['search'])) {
            $products->where('name', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('code', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('barcode', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : Product::PER_PAGE;
        return $products->paginate($per)->appends($request);
    }

    /**
     * get a product set by id.
     * @param $id
     * @return object
     */
    public function getProductSetsById($id)
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