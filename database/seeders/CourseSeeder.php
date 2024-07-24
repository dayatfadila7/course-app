<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            ['id' => 1, 'course' => 'C++', 'mentor' => 'Ari', 'title' => 'Dr.', 'fee' => 110000],
            ['id' => 2, 'course' => 'C#', 'mentor' => 'Ari', 'title' => 'Dr.', 'fee' => 120000],
            ['id' => 3, 'course' => 'C#', 'mentor' => 'Ari', 'title' => 'Dr.', 'fee' => 130000],
            ['id' => 4, 'course' => 'CSS', 'mentor' => 'Cania', 'title' => 'S.Kom', 'fee' => 140000],
            ['id' => 5, 'course' => 'HTML', 'mentor' => 'Cania', 'title' => 'S.Kom', 'fee' => 150000],
            ['id' => 6, 'course' => 'Javascript', 'mentor' => 'Cania', 'title' => 'S.Kom', 'fee' => 160000],
            ['id' => 7, 'course' => 'Python', 'mentor' => 'Barry', 'title' => 'S.T.', 'fee' => 170000],
            ['id' => 8, 'course' => 'Micropython', 'mentor' => 'Barry', 'title' => 'S.T.', 'fee' => 180000],
            ['id' => 9, 'course' => 'Java', 'mentor' => 'Darren', 'title' => 'M.T.', 'fee' => 190000],
            ['id' => 10, 'course' => 'Ruby', 'mentor' => 'Darren', 'title' => 'M.T.', 'fee' => 200000],
        ];

        foreach ($courses as $course) {
            DB::table('courses')->updateOrInsert(
                ['id' => $course['id']],
                [
                    'course' => $course['course'],
                    'mentor' => $course['mentor'],
                    'title' => $course['title'],
                    'fee' => $course['fee'],
                ]
            );
        }
    }
}
