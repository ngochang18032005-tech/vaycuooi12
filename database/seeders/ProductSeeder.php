<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [];

        // Tạo 10 sản phẩm ngẫu nhiên
        for ($i = 1; $i <= 10; $i++) {
            $title = "Product $i";
            $products[] = [
                'product_name' => $title,
                'slug' => Str::slug($title),
                'cat_id' => rand(1, 5), // Giả sử có 5 danh mục
                'brand_id' => rand(1, 3), // Giả sử có 3 thương hiệu
                'image' => "https://via.placeholder.com/300.png?text=Product+$i",
                'price' => rand(100, 500) * 1000, // Giá ngẫu nhiên từ 100,000 - 500,000
                'description' => "Description for $title.",
                'is_on_sale' => rand(0, 1),
                'sale_price' => rand(50, 300) * 1000, // Giá sale từ 50,000 - 300,000
                'views' => rand(0, 1000),
                'qty' => rand(1, 50),
                'created_by' => rand(1, 3), // Giả sử có 3 người tạo
                'updated_by' => rand(1, 3),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Chèn tất cả sản phẩm vào cơ sở dữ liệu
        DB::table('products')->insert($products);
    }
}
