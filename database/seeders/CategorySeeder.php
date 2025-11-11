<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Áo sơ mi',
                'slug' => Str::slug('Áo sơ mi'),
                'parent_id' => 0,
                'sort_order' => 1,
                'image' => 'ao-so-mi.jpg',
                'description' => 'Áo sơ mi cao cấp, phù hợp công sở và đi chơi.',
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}