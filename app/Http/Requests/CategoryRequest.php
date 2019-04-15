<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                Rule::unique('categories')->ignore($this->id)
            ],
            'order' => 'bail|nullable|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'bắt buộc phải nhập tên danh mục',
            'name.unique' => 'danh mục đã tồn tại',
            'order.min' => 'Thứ tự phải là số và giá trị nhỏ nhất là 0',
            'order.numeric' => 'Thứ tự phải là số và giá trị nhỏ nhất là 0'
        ];
    }
}
