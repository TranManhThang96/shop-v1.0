<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'name' => 'required',
            'discount' => 'required',
            'start' => 'required',
            'end' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên chương trình khuyến mại',
            'discount.required' => 'Vui lòng nhập giá trị khuyến mại',
            'start.required' => 'Chọn thời gian bắt đầu',
            'end.required' => 'Chọn thời gian kết thúc'
        ];
    }
}
