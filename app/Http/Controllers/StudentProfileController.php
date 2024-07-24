<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('courses'); // Eager load courses
        $courses = $user->courses;

        return view('students.show', compact('user', 'courses'));
    }
}
