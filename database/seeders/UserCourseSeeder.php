<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userCourses = [
            ['id_user' => 1, 'id_course' => 1],
            ['id_user' => 2, 'id_course' => 2],
            ['id_user' => 3, 'id_course' => 3],
            ['id_user' => 4, 'id_course' => 4],
            ['id_user' => 5, 'id_course' => 5],
            ['id_user' => 6, 'id_course' => 6],
            ['id_user' => 1, 'id_course' => 7],
            ['id_user' => 2, 'id_course' => 8],
            ['id_user' => 3, 'id_course' => 9],
            ['id_user' => 4, 'id_course' => 1],
            ['id_user' => 5, 'id_course' => 3],
            ['id_user' => 6, 'id_course' => 2],
            ['id_user' => 1, 'id_course' => 4],
            ['id_user' => 2, 'id_course' => 5],
            ['id_user' => 3, 'id_course' => 6],
        ];

        foreach ($userCourses as $userCourse) {
            DB::table('userCourse')->updateOrInsert(
                ['id_user' => $userCourse['id_user'], 'id_course' => $userCourse['id_course']],
                []
            );
        }
    }
}
