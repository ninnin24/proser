<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            NovelSeeder::class, // เรียกใช้ NovelSeeder
        ]);
        \App\Models\User::factory(100)->create();
    }
    
}