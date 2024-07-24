@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Course</h2>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('courses.update', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="text" class="form-control" id="course" name="course"
                                    value="{{ old('course', $course->course) }}" required>
                                @error('course')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="mentor">Mentor</label>
                                <input type="text" class="form-control" id="mentor" name="mentor"
                                    value="{{ old('mentor', $course->mentor) }}" required>
                                @error('mentor')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $course->title) }}" required>
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fee">Fee</label>
                                <input type="number" class="form-control" id="fee" name="fee"
                                    value="{{ old('fee', $course->fee) }}" required>
                                @error('fee')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection