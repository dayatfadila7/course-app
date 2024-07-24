<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userCourses = DB::table('userCourse')
                ->join('users', 'userCourse.id_user', '=', 'users.id')
                ->join('courses', 'userCourse.id_course', '=', 'courses.id')
                ->select('users.id as id_user', 'users.username')
                ->selectRaw('COUNT(userCourse.id_course) as course_count')
                ->selectRaw('SUM(courses.fee) as total_fee')
                ->groupBy('users.id', 'users.username')
                ->get();

            return datatables()->of($userCourses)
                ->addColumn('action', function ($user) {
                    $button = "
                    <a href='" . route('users.show', $user->id_user) . "' class='btn btn-info btn-sm'>Detail</a>
                    <a href='" . route('users.edit', $user->id_user) . "' class='btn btn-warning btn-sm'>Edit</a>
                    <form action='" . route('users.destroy', $user->id_user) . "' method='POST' style='display: inline;' onsubmit='return confirmDelete()'>
                        <input type='hidden' name='_token' value='" . csrf_token() . "'>
                    <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                    </form>
                    <script>
                        function confirmDelete() {
                            return confirm('Are you sure you want to delete this user?');
                        }
                    </script>
                ";
                    return $button;
                })
                ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        $courses = Course::all();
        return view('users.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        if (isset($validated['courses'])) {
            $user->courses()->sync($validated['courses']);
        }

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        $courses = $user->courses()->get();

        return view('users.show', compact('user', 'courses'));
    }

    public function edit(User $user)
    {
        $courses = Course::all();
        return view('users.edit', compact('user', 'courses'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'courses' => 'array',
            'courses.*' => 'exists:courses,id',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
        ]);

        if (isset($validated['courses'])) {
            $user->courses()->sync($validated['courses']);
        }

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->courses()->detach(); // Menghapus relasi dari tabel pivot
        $user->delete(); // Menghapus pengguna dari tabel users

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
