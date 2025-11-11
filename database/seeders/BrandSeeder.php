<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'Prada',
                'slug' => Str::slug('Prada'),
                'image' => 'nike.jpg',
                'description' => 'A global leader in sportswear and athletic gear.',
                'sort_order' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Louis Vuitton',
                'slug' => Str::slug('Louis Vuitton'),
                'image' => 'Chanel.jpg',
                'description' => 'A global leader in sportswear and athletic gear.',
                'sort_order' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Versace',
                'slug' => Str::slug('Versace'),
                'image' => 'Gucci.jpg',
                'description' => 'A global leader in sportswear and athletic gear.',
                'sort_order' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hermès',
                'slug' => Str::slug('Hermès'),
                'image' => 'Dior.jpg',
                'description' => 'A global leader in sportswear and athletic gear.',
                'sort_order' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}