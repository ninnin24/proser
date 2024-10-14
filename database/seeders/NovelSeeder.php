<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Novel; 
use Faker\Factory as Faker;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create(); // สร้างตัวอย่าง Faker

        for ($i = 0; $i < 100; $i++) {
            Novel::create([
                'title' => $faker->sentence($nbWords = 3, $variableNbWords = true), // สุ่มชื่อเรื่อง
                'author' => $faker->name, // 
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true), // สุ่มคำบรรยาย
                'created_at' => now(), // ใช้เวลาปัจจุบัน
                'updated_at' => now(), // ใช้เวลาปัจจุบัน
            ]);
        }
    }
}
