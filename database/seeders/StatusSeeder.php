<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            'name' => 'Newly Logged'
        ]);

        DB::table('statuses')->insert([
            'name' => 'In Progress'
        ]);

        DB::table('statuses')->insert([
            'name' => 'Resolved'
        ]);
    }
}
