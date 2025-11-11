<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categories';
    protected $fillable = ['category_name', 'slug', 'parent_id', 'sort_order', 'image', 'description', 'status'];

    // Lấy danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    // Lấy danh mục cha (không bắt buộc, chỉ cần nếu muốn)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    // khóa 
    public function products(): HasMany{
        return $this->hasMany(Product::class, 'cat_id');
    }


    // Tạo slug tự động trước khi lưu
    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->category_name);
            }
        });

        static::updating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->category_name);
            }
        });
    }
}