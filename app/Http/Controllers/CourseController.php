<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $courses = Course::query();
            return DataTables::of($courses)
                ->addColumn('action', function ($course) {
                    return '<a href="' . route('courses.edit', $course->id) . '" class="btn btn-primary btn-sm">Edit</a>
                    <form action="' . route('courses.destroy', $course->id) . '" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <script>
                        function confirmDelete() {
                            return confirm("Are you sure you want to delete this course?");
                        }
                    </script>';
                })
                ->make(true);
        }

        return view('courses.index');
    }
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'mentor' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'fee' => 'required|numeric',
        ]);

        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'mentor' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'fee' => 'required|numeric',
        ]);

        $course->update($request->all());
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }
}
