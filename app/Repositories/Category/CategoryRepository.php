<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 3/23/2019
 * Time: 12:33 AM
 */

namespace App\Repositories\category;

use App\Repositories\RepositoryAbstract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryRepository extends RepositoryAbstract implements CategoryRepositoryInterface
{
    /**
     * Construct
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        parent::__construct();
        $this->model = $category;
        $this->table = 'categories';
    }

    /**
     * Get list category.
     *
     * @param $filter
     * @return array object
     */
    public function getCategories($request)
    {
        $categories = $this->model->orderBy('id', 'desc');

        if (!empty($request['search'])) {
            $categories->where('name', 'LIKE', '%' . $request['search'] . '%');
        }
        $per = isset($request['per']) ? $request['per'] : 10;
        return $categories->paginate($per)->appends($request);
    }

    /**
     * Get all categories.
     *
     * @return Collection
     */
    public function getAllCategories($id=null)
    {
        if (!empty($id)) {
            return $this->model->where('id','<>',$id)->get();
        }
        return $this->model->all();
    }

    /**
     * Get category by id.
     *
     * @param $id
     * @return object
     */
    public function getCategoryById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Destroy category.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        $category = $this->model->find($id);
        if (!empty($category)) {
            $count = $this->model->where('parent_id', $id)->where('id','<>',$id)->count();
            if ($count == 0) {
                return $category->delete();
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Store category.
     *
     * @param array $request
     * @return bool|void
     */
    public function store($request)
    {
        $this->model->fill($request->all());
        $this->model->slug = Str::slug($request->name);
        return $this->model->save();
    }

    /**
     * Update category.
     *
     * @param array|int $request
     * @param array $id
     * @return void
     */
    public function update($request, $id)
    {
        $category = $this->model->find($id);
        if (!empty($category)) {
            $category->fill($request->all());
            $category->slug = Str::slug($request->name);
            return $category->save();
        }
        return false;
    }

    public function checkExist($name, $categoryId = null)
    {
        $categories = $this->model->where('name', $name);
        if (!empty($categoryId)) {
            $categories = $categories->where('id', '<>', $categoryId);
        }
        if ($categories->count() > 0) {
            return false;
        }

        return true;
    }

    public function changeStatus($id, $status)
    {
        $category = $this->model->find($id);
        if (!empty($category)) {
            $category->active = $status;
            return $category->save();
        }
        return false;
    }
}