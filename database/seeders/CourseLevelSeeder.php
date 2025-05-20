<?php

namespace Database\Seeders;

use App\Models\CourseLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseLevel = [
            [
                'name' => 'Beginner',
                'slug' => 'beginner',
            ],
            [
                'name' => 'Intermediate',
                'slug' => 'intermediate',
            ],
            [
                'name' => 'Advanced',
                'slug' => 'advanced',
            ],
        ];

        CourseLevel::insert($courseLevel);
    }
}
