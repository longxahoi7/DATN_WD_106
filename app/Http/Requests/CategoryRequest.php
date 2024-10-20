<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'slug' => 'required|alpha_dash|unique:brands,slug',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Yều cầu không để trống',
            'description.required' => 'Yều cầu không để trống',
            'image.required' => 'Yều cầu không để trống',
            'is_active.boolean' => 'Chỉ nhận giá trị true hoặc false hay 0 hoặc 1',
            'slug.alpha_dash' => ' cho phép ký tự chữ cái, số, dấu gạch ngang và dấu gạch dưới',
        ];
    }
}
