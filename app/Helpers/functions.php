<?php
/**
 * Created by PhpStorm.
 * User: manht
 * Date: 2/1/2019
 * Time: 10:15 AM
 */
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

//Danh muc con
function getChild($str = '', $id, $symbol = '')
{
    $model = new Category();
    $allCate = $model->all();
    $currentCate = $model->find($id);
    $str = $symbol . $currentCate->name;
    foreach ($allCate as $item) {
        if ($item->parent_id == $id) {
            $str .= getChild($str, $item->id, '-->');
        }
    }
    return $str;
}

//Danh muc cha
function getParent($str = '', $id, $symbol = '')
{
    $model = new Category();
    $currentCate = $model->find($id);
    $str = $currentCate->name. $symbol;
    if ($currentCate->parent_id == 0) {
        return $str;
    } else {
        $str = getParent($str,$currentCate->parent_id,'-->').$str;
    }
    return $str;
}

//hien thi menu
function showCategories($categories, $parent_id = 0, $symbol = '',$select = 0)
{
    foreach ($categories as $key => $item) {
        // Nếu là chuyên mục cha thì hiển thị
        if ($item->parent_id == $parent_id) {
            if($select == $item->id) {
                echo "<option value='{$item->id}' selected>"  . $symbol . $item->name . "</option>";
            } else {
                echo "<option value='{$item->id}'>" . $symbol . $item->name . "</option>";
            }
            // Xóa chuyên mục đã lặp
            unset($categories[$key]);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $item->id, $symbol . '|---');
        }
    }
}

/**
 * 3/7/2019 3:17 PM format date
 */

function formatDate($input, $inputFormat="Y-m-d H:i:s", $format="d/m/Y H:i:s")
{
    if($input != null && $input != '') {
        $date = DateTime::createFromFormat($inputFormat, $input);
        return $date->format($format);
    }
}

function getProvinces()
{
    $arr = DB::table('provinces')->select('id')->get()->toArray();
    return Arr::pluck($arr,'id');
}

function getDistrict()
{
    $arr = DB::table('districts')->select('id')->get()->toArray();
    return Arr::pluck($arr,'id');
}

function getWards()
{
    $arr = DB::table('wards')->select('id')->get()->toArray();
    return Arr::pluck($arr,'id');
}

function substringIfLength($str, $len = 100) {
    if (strlen($str) > 100) {
        $pos = strrpos(substr($str,0,100),' ');
        return substr($str,0,$pos).' .....';
    }
    return $str;
}

function getAmount($money)
{
    $cleanString = str_replace('.','',$money);
    return (int)$cleanString;
}