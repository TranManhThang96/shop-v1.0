<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CustomerRequest extends FormRequest
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
            'email' => [
                'nullable',
                'email',
                Rule::unique('customers')->ignore($this->id)
            ],
            'age' => 'nullable|numeric',
            'phone' => [
                'required',
                'numeric',
                Rule::unique('customers')->ignore($this->id),
            ],
            'province_id' => 'numeric|min:1',
            'district_id' => 'numeric|min:1',
            'ward_id' => 'numeric|min:1',
            'street' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải nhập tên',
            'email.email' => 'Email chưa đúng định dạng',
            'email.unique' => 'Email này đã được đăng ký',
            'age.numeric' => 'Chỉ bao gồm ký tự số',
            'phone.required' => 'Bắt buộc nhập số điện thoại',
            'phone.numeric' => 'Chỉ bao gồm ký tự số',
            'phone.unique' => 'SĐT này đã được đăng ký',
            'province_id.min' => 'Vui lòng chọn tỉnh/thành phố',
            'district_id.min' => 'Vui lòng chọn quận/huyện',
            'ward_id.min' => 'Vui lòng chọn xã/phường',
            'street.required' => 'Bắt buộc nhập số nhà/thôn xóm',
        ];
    }
}
