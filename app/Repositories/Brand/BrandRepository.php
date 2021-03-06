<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\Brand;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Brand;
use Illuminate\Support\Str;
class BrandRepository extends RepositoryAbstract implements BrandRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Brand $brand)
    {
        parent::__construct();
        $this->model = $brand;
        $this->table = 'brands';
    }

    /**
     * Get list product set.
     *
     * @param $filter
     * @return array object
     */
    public function getBrands($request)
    {
        $brands = $this->model->orderBy('id', 'desc');

        if (!empty($request['search'])) {
            $brands->where('name', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : 10;
        return $brands->paginate($per)->appends($request);
    }

    /**
     * Get brand by id.
     *
     * @param $id
     * @return object
     */
    public function getBrandById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy brand.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $brand = $this->model->find($id);
        if (!empty($brand)) {
            return $brand->delete();
        }
        return false;
    }

    /**
     * Store brand.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->slug = Str::slug($request->name);
        if (!empty ($request->image)) {
            $exist = Storage::exists('brands/' . $request->image->getClientOriginalName());
            //neu chua ton tai thi upload, neu ton tai roi thi cap nhat link anh bang link da ton tai
            if (!$exist) {
                $path = $request->file('image')->storeAs('brands', $request->image->getClientOriginalName());
                $this->model->image = $path;
            } else {
                $this->model->image = 'brands/' . $request->image->getClientOriginalName();
            }
        }
        return $this->model->save();
    }

    /**
     * Update brand.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $brand = $this->model->find($id);
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->content = $request->content;
        if (!empty($request->image)) {
            $exist = Storage::exists('brands/' . $request->image->getClientOriginalName());
            // neu file chua ton tai thi them file moi vao, xoa file cu.
            // neu ton tai thi cap nhat lai link anh
            if (!$exist) {
                if ($this->model->where('image', $brand->image)->where('id', '<>', $id)->count() == 0) {
                    Storage::delete($brand->image);
                }

                //them file moi
                $path = $request->file('image')->storeAs('brands', $request->image->getClientOriginalName());
                $brand->image = $path;
            } else {
                $brand->image = 'brands/' . $request->image->getClientOriginalName();
            }

        }
        return $brand->save();

    }

    /**
     * Check brand exist.
     *
     * @param $name
     * @param null $brandId
     * @return bool
     */
    public function checkExist($name, $brandId = null)
    {
        $brands = $this->model->where('name',$name);
        if(!empty($brandId)) {
            $brands = $brands->where('id','<>',$brandId);
        }
        if($brands->count() > 0) {
            return false;
        }
        return true;
    }

    /**
     * Get all brands.
     *
     * @return Collection
     */
    public function getAllBrands()
    {
        return $this->model->all();
    }

}