<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'fullname' => "User $i",
                'username' => "user$i",
                'email' => "user$i@example.com",
                'phone' => '012345678' . $i, // Tạo số điện thoại giả
                'address' => "Address $i",
                'birthday' => now()->subYears(rand(18, 40))->toDateString(),
                'gender' => (rand(0, 1) ? 'male' : 'female'),
                'avatar' => "https://via.placeholder.com/150.png?text=User+$i",
                'password' => Hash::make('password123'), // Mật khẩu mặc định
                'email_verified_at' => now(),
                'role' => (rand(0, 1) ? 'admin' : 'user'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('custom_users')->insert($users);
    }
}
