<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [];

        for ($i = 1; $i <= 10; $i++) {
            $title = "Sample Post $i";
            $posts[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => "This is the content of post $i.",
                'description' => "Short description for post $i.",
                'thumbnail' => "https://via.placeholder.com/300.png?text=Post+$i",
                'created_by' => rand(1, 5), // Giả sử có 5 người dùng
                'updated_by' => rand(1, 5),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('posts')->insert($posts);
    }
}
