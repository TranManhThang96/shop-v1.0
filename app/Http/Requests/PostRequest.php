<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => ['required', 'max:255', Rule::unique('posts')->ignore($this->id)],
            'short_description' => 'required|max:255',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết',
            'title.max' => 'Vui lòng nhập không quá 255 ký tự',
            'title.unique' => 'Bài viết đã tồn tại',
            'short_description.required' => 'Vui lòng nhập mô tả ngắn cho bài viết',
            'short_description.max' => 'Vui lòng nhập không quá 255 ký tự',
            'content.required' => 'Vui lòng nhập nội dung cho bài viết'
        ];
    }
}
