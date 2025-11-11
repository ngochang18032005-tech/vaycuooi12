<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'sort_order',
        'created_by',
        'updated_by',
        'status',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'brand_id'); // giả sử brand_id lưu trong bảng categories
    }

    // Một thương hiệu có nhiều sản phẩm
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}