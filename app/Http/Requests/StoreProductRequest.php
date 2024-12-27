<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'brand_id' => 'required|exists:brands,id', // Đảm bảo tồn tại brand_id trong bảng brands
            'name' => 'required|string|max:255',      // Tên sản phẩm bắt buộc, chuỗi và tối đa 255 ký tự
            'product_category_id' => 'required|exists:product_categories,id', // Đảm bảo tồn tại category
            'main_image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ảnh hợp lệ
            'sku' => 'required|string|max:100|unique:products,sku', // Mã SKU duy nhất
            'description' => 'nullable|string',      // Mô tả có thể trống
            'subtitle' => 'nullable|string|max:255', // Phụ đề tối đa 255 ký tự
            'color_id' => 'required',                // Phải có màu
            'size_id' => 'required',                 // Phải có kích thước
            'is_active' => 'nullable|boolean',       // Giá trị boolean
        ];
    }
    public function messages()
    {
        return [
            'brand_id.required' => 'Thương hiệu là bắt buộc.',
            'brand_id.exists' => 'Thương hiệu không tồn tại.',
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'sku.required' => 'Mã SKU là bắt buộc.',
            'sku.unique' => 'Mã SKU đã tồn tại.',
            'color_id.required' => 'Bạn phải chọn ít nhất một màu.',
            'size_id.required' => 'Bạn phải chọn ít nhất một kích thước.',
        ];
    }
}
