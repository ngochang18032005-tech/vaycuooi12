<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [];

        for ($i = 1; $i <= 10; $i++) {
            $orders[] = [
                'user_id' => rand(1, 5), // Giả sử có 5 user
                'name' => "Customer $i",
                'email' => "customer$i@example.com",
                'phone' => '098765432' . $i,
                'address' => "123 Street, City $i",
                'created_by' => rand(1, 5), // Giả sử admin tạo đơn
                'updated_by' => rand(1, 5),
                'status' => rand(0, 1), // 0: Pending, 1: Completed
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}