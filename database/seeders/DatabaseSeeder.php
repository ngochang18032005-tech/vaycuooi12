<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            BannerSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ContactSeeder::class,
            CustomUserSeeder::class,
            MenuSeeder::class,
            OrderDetailSeeder::class,
            OrderSeeder::class,
            PostSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
        ]);
        
    }
}
