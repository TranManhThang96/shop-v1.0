<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('products')->ignore($this->id)],
            'cat_id' => 'numeric|min:1',
            'price' => 'required',
            'iprice' => 'required',
//            'img_link' => 'required|file|image',
            'items.*.price' => 'required',
            'items.*.iprice' => 'required',
            'items.*.quantity' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Vui lòng nhập không quá 255 ký tự',
            'name.unique' => 'Sản phẩm đã tồn tại',
            'cat_id.min' => 'Vui lòng chọn danh mục',
            'price.required' => 'Vui lòng nhập giá niêm yết',
            'price.numeric' => 'Giá niêm yết chưa đúng',
            'iprice.required' => 'Vui lòng nhập giá nhập',
            'iprice.numeric' => 'Giá nhập chưa đúng',
            'img_link.required' => 'Vui lòng upload ảnh',
            'img_link.image' => 'Chỉ hỗ trợ định dạng (jpeg, png, bmp, gif, or svg)',
            'items.*.price.required' => 'Vui lòng nhập giá niêm yết',
            'items.*.price.numeric' => 'Giá niêm yết chưa đúng',
            'items.*.iprice.required' => 'Vui lòng nhập giá nhập',
            'items.*.iprice.numeric' => 'Giá nhập chưa đúng',
            'items.*.quantity.required' => 'Vui lòng nhập số lượng',
            'items.*.quantity.integer' => 'Số lượng chưa đúng',
            'items.*.quantity.min' => 'Giá trị nhỏ nhất là 1',
        ];
    }
}
