<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'name' => 'Main Slideshow Banner',
                'link' => 'https://example.com',
                'image' => 'banner1.jpg',
                'position' => 'slideshow',
                'description' => 'This is the main slideshow banner.',
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
