<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class SupplierRequest extends FormRequest
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
            'name' => ['required', Rule::unique('suppliers')->ignore($this->name)],
            'phone' => ['required','numeric',Rule::unique('suppliers')->ignore($this->phone)],
            'email' => 'nullable|email',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bắt buộc phải điền tên NCC',
            'name.unique' => 'Tên nhà cung cấp đã tồn tại',
            'phone.required' => 'Bắt buộc phải điền SĐT',
            'phone.numeric' => 'Số điện thoại chưa đúng định dạng',
            'phone.unique' => 'Số điện thoại nhà cung cấp đã tồn tại',
            'email.email' => 'Email chưa đúng định dạng',
            'address.required' => 'Bắt buộc phải điền tên address'
        ];
    }
}
