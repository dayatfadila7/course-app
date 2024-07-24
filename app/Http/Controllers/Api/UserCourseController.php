<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserCourseController extends Controller
{
    public function getCourseData()
    {
        $data = DB::table('userCourse')
            ->join('courses', 'userCourse.id_course', '=', 'courses.id')
            ->select('courses.course', 'courses.mentor', 'courses.title', DB::raw('COUNT(userCourse.id_user) as participant_count'))
            ->groupBy('courses.course', 'courses.mentor', 'courses.title')
            ->get();

        return response()->json($data);
    }

    public function getMentorData()
    {
        $data = DB::table('userCourse')
            ->join('courses', 'userCourse.id_course', '=', 'courses.id')
            ->select('courses.mentor', DB::raw('COUNT(userCourse.id_user) as participant_count'), DB::raw('SUM(courses.fee) as total_fee'))
            ->groupBy('courses.mentor')
            ->get();

        return response()->json($data);
    }

    public function getDataSarjana()
    {
        $data = DB::table('userCourse')
            ->join('users', 'userCourse.id_user', '=', 'users.id')
            ->join('courses', 'userCourse.id_course', '=', 'courses.id')
            ->select('users.username', 'courses.course', 'courses.mentor', 'courses.title')
            ->whereIn('courses.title', ['S.Kom', 'S.T.'])
            ->get();

        return response()->json($data);
    }

    public function getDataMagister()
    {
        $data = DB::table('userCourse')
            ->join('users', 'userCourse.id_user', '=', 'users.id')
            ->join('courses', 'userCourse.id_course', '=', 'courses.id')
            ->select('users.username', 'courses.course', 'courses.mentor', 'courses.title')
            ->whereIn('courses.title', ['Dr.', 'M.T.'])
            ->get();

        return response()->json($data);
    }
}
