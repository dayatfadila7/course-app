@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h3>Course Participation by Title</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="courseChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Mentor Statistics</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="mentorChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctxCourse = document.getElementById('courseChart').getContext('2d');
            var ctxMentor = document.getElementById('mentorChart').getContext('2d');

            // Mengambil data dari API
            fetch('/api/course-data')
                .then(response => response.json())
                .then(data => {
                    var courseLabels = data.map(item => `${item.course} (${item.mentor}, title: ${item.title})`);
                    var participantCounts = data.map(item => item.participant_count);

                    new Chart(ctxCourse, {
                        type: 'bar',
                        data: {
                            labels: courseLabels,
                            datasets: [{
                                label: 'Jumlah Peserta',
                                data: participantCounts,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });

            fetch('/api/mentor-data')
                .then(response => response.json())
                .then(data => {
                    var mentorLabels = data.map(item => item.mentor);
                    var participantCountsMentor = data.map(item => item.participant_count);
                    var totalFees = data.map(item => item.total_fee);

                    new Chart(ctxMentor, {
                        type: 'bar',
                        data: {
                            labels: mentorLabels,
                            datasets: [{
                                    label: 'Jumlah Peserta',
                                    data: participantCountsMentor,
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    borderWidth: 1
                                },
                                {
                                    label: 'Total Fee',
                                    data: totalFees,
                                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    borderWidth: 1
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endpush
