<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    
    public function messages(): array
    {
        return [
            'productName.required'  => 'Tên sản phẩm là bắt buộc.',
            'productName.unique'    => 'Tên sản phẩm đã tồn tại.',
            'slug.required'         => 'Slug là bắt buộc.',
            'slug.unique'           => 'Slug đã tồn tại.',
            'cat.required'          => 'Danh mục là bắt buộc.',
            'price.required'        => 'Giá tiền là bắt buộc.',
            'price.numeric'         => 'Giá tiền phải là số.',
            'sale_price.numeric'    => 'Giá khuyến mãi phải là số.',
            'sale_price.lt'         => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'brand.required'        => 'Thương hiệu là bắt buộc.',
            'image.image'           => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes'           => 'Hình ảnh phải có định dạng hợp lệ (jpeg, png, jpg, gif, svg).',
            'image.max'             => 'Hình ảnh không được lớn hơn 2MB.',
        ];
    }
    
   
    public function rules(): array
    {
        $slug = $this->route('product'); // Lấy slug từ URL
        $product = Product::where('slug', $slug)->first();
    
        return [
            'productName'  => ['required', 'string', 'max:255', Rule::unique('products', 'product_name')->ignore($product?->id)],
            'slug'         => ['required', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product?->id)],
            'cat'          => 'required|integer|exists:categories,id',
            'description'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price'        => 'required|numeric|min:0',
            'sale_price'   => 'nullable|numeric|lt:price', // sale_price phải nhỏ hơn price
            'brand'        => 'required|numeric|exists:brands,id',
            'qty'          => 'nullable|integer|min:0',
            'status'       => 'required|boolean',
        ];
    }
    
}