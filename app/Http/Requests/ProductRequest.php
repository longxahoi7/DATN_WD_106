<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'brand_id' => 'required|integer|exists:brands,brand_id', // Kiểm tra brand_id phải tồn tại trong bảng brands
            'product_category_id' => 'required|integer|exists:categories,category_id', // Kiểm tra category_id phải tồn tại trong bảng categories
            'name' => 'required|string|max:255', // Tên sản phẩm là bắt buộc và không quá 255 ký tự
            'main_image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh chính
            'sku' => 'required|string|max:255|unique:products,sku', // Mã sản phẩm là bắt buộc, không được trùng lặp
            'description' => 'required|string', // Mô tả sản phẩm là bắt buộc
            'subtitle' => 'nullable|string|max:255', // Phụ đề có thể rỗng nhưng không quá 255 ký tự
            'attribute_id' => 'required|array', // ID thuộc tính là bắt buộc và phải là một mảng
            'attribute_id.*' => 'integer|exists:attributes,attribute_id', // Kiểm tra từng thuộc tính trong mảng phải tồn tại
            'discount' => 'nullable|numeric|min:0', // Giảm giá có thể rỗng, phải là số và không âm
            'in_stock' => 'nullable|integer|min:0', // Số lượng có thể rỗng, phải là số nguyên và không âm
            'price' => 'required|numeric|min:0', // Giá phải là bắt buộc, là số và không âm
        ];
    }
}
