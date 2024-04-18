<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['name' => 'drama'],
            ['name' => 'prose'],
            ['name' => 'nonfiction'],
            ['name' => 'poetry'],
            ['name' => 'fiction'],
        ]);
    }
}
