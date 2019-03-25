<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

class CategoryController extends Controller
{
    public $strGlobal;

    public function list(Request $request)
    {
        $model = new Category();
        $keyword = '';
        $limit = 5;
        $page = isset($request->page) ? $request->page : 1;
        if (isset($request->limit)) {
            $limit = $request->limit;
        }
        if (isset($request->keyword)) {
            $keyword = $request->keyword;
            $listCategories = $model->where('name', 'LIKE', '%' . $keyword . '%')->orderBy('id', 'desc')->paginate($limit);
            $listCategories->withPath("?keyword = $keyword"); //dùng để hiển thị keyword khi phân trang sang page thứ 2
        } else {
            $listCategories = $model->orderBy('id', 'desc')->paginate($limit);
        }

        $allCategories = $model->all();
        return view('admin.category.list', compact('listCategories', 'allCategories', 'model', 'keyword','page','limit'));
    }

    public function save(Request $request)
    {
        $model = new Category();
        $request->validate([
            'name' => 'bail|required|unique:categories',
            'order' => 'bail|nullable|numeric|min:0'
        ], [
            'name.required' => 'bắt buộc phải nhập tên danh mục',
            'name.unique' => 'danh mục đã tồn tại',
            'order.min' => 'Giá trị nhỏ nhất là 0',
            'order.numeric' => 'Yêu cầu phải là số'
        ]);
        $model->alias = str_slug($request->name);
        $model->fill($request->all());
        if ($request->order == null)
            $model->order = 0;
        $model->save();
        return redirect(route('admin.category.list'));
    }

    public function remove(Request $request)
    {
        $model = Category::find($request->id);
        $model->delete();
        return redirect(route('admin.category.list'));
    }

    public function changeStatus(Request $request)
    {
        $model = Category::find($request->id);
        $model->active = $request->active;
        $model->save();
        return response()->json('true');
    }

    //Danh muc con
    public function getChild($str = '', $id, $symbol = '')
    {
        $model = new Category();
        $allCate = $model->all();
        $currentCate = $model->find($id);
        $str = $symbol . $currentCate->name;
        foreach ($allCate as $item) {
            if ($item->parent_id == $id) {
                $str .= $this->getChild($str, $item->id, '-->');
            }
        }
        return $str;
    }

    //Danh muc cha
    public function getParent($str = '', $id, $symbol = '')
    {
        $model = new Category();
        $currentCate = $model->find($id);
        $str = $symbol . $currentCate->name;
        if ($currentCate->parent_id == 0) {
            return $str;
        } else {
            $str .= $this->getParent($str, $currentCate->parent_id, '-->');
        }
        return $str;
    }

    //in ra menu bằng lệnh echo luôn
    function showCategories($categories, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục cha thì hiển thị
            if ($item->parent_id == $parent_id) {
                echo '<option value="' . $item->id . '">';
                echo $char . $item->name;
                echo '</option>';

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->showCategories($categories, $item->id, $char . '|---');
            }
        }
    }

    //in ra menu theo kiểu trả về chuỗi option
    public function showCate($categories, $parent_id, $symbol, $select = 0)
    {
        foreach ($categories as $key => $item) {
            if ($item->parent_id == $parent_id) {
                if ($select == $item->id) {
                    $this->strGlobal .= "<option value='{$item->id}' selected>" . $symbol . $item->name . "</option>";
                } else {
                    $this->strGlobal .= "<option value='{$item->id}'>" . $symbol . $item->name . "</option>";
                }
                unset($categories[$key]);
                $this->showCate($categories, $item->id, $symbol . '|--', $select);
            }
        }

    }

    //check tên category tồn tại
    public function checkExist(Request $request)
    {
        $model = new Category();
        if (isset($request->id)) {
            $cate = $model->where('name', '=', $request->name)->where('id', '<>', $request->id)->get();
        } else {
            $cate = $model->where('name', '=', $request->name)->get();
        }
        Log::info('đã vào đây request',['id'=> $request->id]);
        if (count($cate) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function test()
    {
        $model = new Category();
        $all = $model->find(2)->product;
        foreach ($all as $pro) {
            echo $pro->name;
        }
    }

}
