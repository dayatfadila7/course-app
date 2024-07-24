@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>User Course</h2>
                        <a href="{{ route('courses.create') }}" type="button" class="btn btn-primary">Add Course</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered" id="courses-table">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Mentor</th>
                                    <th>Title</th>
                                    <th>Fee</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#courses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('courses.index') }}',
                columns: [{
                        data: 'course',
                        name: 'course'
                    },
                    {
                        data: 'mentor',
                        name: 'mentor'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'fee',
                        name: 'fee'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
