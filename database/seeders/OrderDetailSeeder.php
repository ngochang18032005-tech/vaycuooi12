<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $orderDetails = [];

        for ($i = 1; $i <= 10; $i++) {
            $order_id = rand(1, 5); // Giả sử có 5 đơn hàng
            $product_id = rand(1, 10); // Giả sử có 10 sản phẩm
            $qty = rand(1, 5); // Số lượng ngẫu nhiên từ 1-5
            $price = rand(100, 500) * 1000; // Giá ngẫu nhiên từ 100.000 đến 500.000
            $discount = rand(0, 20); // Giảm giá từ 0-20%
            $amount = $price * $qty * (1 - $discount / 100); // Tính tổng tiền sau giảm giá

            $orderDetails[] = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'qty' => $qty,
                'price' => $price,
                'discount' => $discount,
                'amount' => $amount,
            ];
        }

        DB::table('order_details')->insert($orderDetails);
    }
}