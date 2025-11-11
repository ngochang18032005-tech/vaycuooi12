<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->truncate(); // Xóa dữ liệu cũ trước khi seed

        DB::table('menus')->insert([
            [
                'name' => 'Home',
                'link' => '/',
                'position' => 'mainmenu',
                'sort_order' => 1,
                'parent_id' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'About Us',
                'link' => '/about',
                'position' => 'mainmenu',
                'sort_order' => 2,
                'parent_id' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Services',
                'link' => '/services',
                'position' => 'mainmenu',
                'sort_order' => 3,
                'parent_id' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Contact',
                'link' => '/contact',
                'position' => 'footermenu',
                'sort_order' => 1,
                'parent_id' => 0,
                'created_by' => 1,
                'updated_by' => 1,
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
