<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    // Hàm Rules
        public function rules(): array
    {
        return [
            'productName' => 'required|string|max:255|unique:products,product_name',
            'slug' => 'required|string|max:255|unique:products,slug',
            'cat' => 'required|integer|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'brand' => 'required|numeric|exists:brands,id',
            'qty' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ];
    }
    //Hàm messages
        public function messages(): array
    {
        return [
            'productName.required' => 'Tên danh mục là bắt buộc.',
            'productName.unique' => 'Tên danh mục đã tồn tại.',
            'slug.required' => 'Slug là bắt buộc.',
            'slug.unique' => 'Slug đã tồn tại.',
            'cat.required' => 'Danh mục là bắt buộc.',
            'price.required' => 'Giá tiền là bắt buộc.',
            'price.numeric' => 'Giá tiền phải là số.',
            'brand.required' => 'Thương hiệu là bắt buộc.',
            'image.image' => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes' => 'Định dạng hình ảnh không hợp lệ (chỉ chấp nhận jpeg, png, jpg, gif, svg).',
            'image.max' => 'Hình ảnh không được lớn hơn 2MB.',
        ];
    }
}