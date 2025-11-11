<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'products';
    protected $fillable = [
        'product_name', 'slug', 'cat_id', 'brand_id', 'description', 'price', 'sale_price', 'image', 'qty', 'status', 'created_by',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    // Tạo slug tự động trước khi lưu
    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->product_name); // sửa 'name' thành 'product_name'
            }
        });

        static::updating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->product_name); // sửa 'name' thành 'product_name'
            }
        });
    }
}
