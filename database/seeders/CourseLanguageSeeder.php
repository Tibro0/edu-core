<?php

namespace Database\Seeders;

use App\Models\CourseLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseLanguage = [
            [
                'name' => 'English',
                'slug' => 'english',
            ],
            [
                'name' => 'Bangla',
                'slug' => 'bangla',
            ],
            [
                'name' => 'Hindi',
                'slug' => 'hindi',
            ],
            [
                'name' => 'Arabic',
                'slug' => 'arabic',
            ],
        ];

        CourseLanguage::insert($courseLanguage);
    }
}
