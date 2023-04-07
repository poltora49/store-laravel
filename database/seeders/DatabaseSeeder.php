<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(4)->create();
        (\App\Models\Product::factory(20))->create();

        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
