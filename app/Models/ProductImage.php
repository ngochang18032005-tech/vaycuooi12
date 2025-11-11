<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'image',
        'created_by',
        'updated_by',
        'status'
    ];
    public function product(): BeLongsTo{
        return $this->belongsTo(product::class, 'product_id');
    }
    
}
