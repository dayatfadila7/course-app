@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>Detail User</h2>
                        <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">List User</a>
                    </div>
                    <div class="card-body">

                        <div class="mb-4">
                            <h2>{{ $user->name }}</h2>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                        </div>

                        <h3>Courses</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Mentor</th>
                                    <th>Title</th>
                                    <th>Course</th>
                                    <th>Fee</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)
                                    <tr>
                                        <td>{{ $course->mentor }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>{{ $course->course }}</td>
                                        <td>{{ number_format($course->fee, 2, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No courses found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
