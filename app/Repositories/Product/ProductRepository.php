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
use Illuminate\Support\Str;
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
        $products = $this->model->orderBy('id', 'desc')->with('category');

        if (!empty($request['search'])) {
            $products->where('name', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('code', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('barcode', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : Product::PER_PAGE;
        return $products->paginate($per)->appends($request);
    }

    /**
     * Return all products.
     *
     * @return Product[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * get a product set by id.
     * @param $id
     * @return object
     */
    public function getProductById($id)
    {
        return $this->model->with('productItem')->find($id);
    }


    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->slug = Str::slug($this->model->name);
        $this->model->sku = 'SP' . time();
        $this->model->price = getAmount($this->model->price);
        $this->model->iprice = getAmount($this->model->iprice);
        if (!empty($request->img_link)) {
            $path = $request->file('img_link')->storeAs('products', time().$request->file('img_link')->getClientOriginalName());
            $this->model->img_link = $path;
        }
        if (!empty($request->img_list)) {
            $img_list = [];
            foreach ($request->img_list as $key => $img) {
                $path_temp = $request->img_list[$key]->storeAs('products', time().$request->img_list[$key]->getClientOriginalName());
                $img_list[] = $path_temp;
            }
            $this->model->img_list = $img_list;
        }

        if ($this->model->save()) {
            return $this->model;
        }

        return null;
    }

    public function update($request,$id) {
        $product = $this->model->find($id);
        $img_list = !empty($product->img_list) ? $product->img_list : [];
        $img_list_temp = !empty($request->img_list_temp) ? $request->img_list_temp : [];
        $product->fill($request->all());
        $product->slug = Str::slug($request->name);
        $product->price = getAmount($request->price);
        $product->iprice = getAmount($request->iprice);

        //neu ton tai img_link thi xoa anh cu va cap nhat anh moi
        if (!empty($request->img_link)) {
            Storage::delete($product->img_link);
            $path = $request->file('img_link')->storeAs('products', time().$request->file('img_link')->getClientOriginalName());
            $product->img_link = $path;
        }

        //check xem img_list co anh nao bi xoa khong
        if (count(array_diff($img_list,$img_list_temp))> 0) {
            foreach (array_diff($img_list,$img_list_temp) as $img_delete) {
                Storage::delete($img_delete);
            }
        }
        if (!empty($request->img_list)) {
            foreach ($request->img_list as $key => $img) {
                $path_temp = $request->img_list[$key]->storeAs('products', time().$request->img_list[$key]->getClientOriginalName());
                $img_list_temp[] = $path_temp;
            }
        }

        $product->img_list = array_values($img_list_temp);

       if($product->save()) {
           return $product;
       }
       return null;
    }

    public function destroy($id)
    {
        $product = $this->model->find($id);
        if (!empty($product)) {
            return $product->delete();
        }
        return false;
    }

    public function checkExist($name, $productId = null)
    {
        $products = $this->model->where('name',$name);
        if (!empty($productId)) {
            $products = $products->where('id','<>',$productId);
        }
        if ($products->count() > 0) {
            return false;
        }

        return true;
    }

    public function getProductByQuery($request)
    {
        return  $this->model->select('id','name')->where("name","LIKE","%{$request->input('query')}%")->get();
    }

    public function getProductItemBySku($sku)
    {
        $data = [];
        $data = $this->model->with('productItem')->where('sku', $sku)->orWhere('barcode', $sku)->first();
        if (empty($data)) {
            $data = $this->model->with(
                                    ['productItem' => function($query) use ($sku) {
                                        $query = $query->where('sku_item', $sku);
                                    }])
                                ->first();
        }
        return $data;
    }
}