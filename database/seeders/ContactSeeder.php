<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [];

        for ($i = 1; $i <= 10; $i++) {
            $contacts[] = [
                'name' => "User $i",
                'email' => "user$i@example.com",
                'phone' => "012345678$i",
                'title' => "Contact Inquiry $i",
                'content' => "This is a sample contact message from User $i.",
                'status' => 1, // Active
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('contacts')->insert($contacts);
    }
}