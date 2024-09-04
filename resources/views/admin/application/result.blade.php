@extends('partials.admin.header')
@section('content')
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                {{-- <a href="{{ route('admin.job.create') }}" class="btn btn-primary">Add Data</a> --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Score</h5>
                                <h6 class="card-subtitle text-muted">Your current score is displayed below.</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center" style="height: 252px;">
                                    <h1 id="score" style="font-size: 6rem;">85</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Statistik Jawaban</h5>
                                <h6 class="card-subtitle text-muted">Pie charts are excellent at showing the relational proportions between data.</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart chart-sm">
                                    <div class="chartjs-size-monitor">
                                        <div class="chartjs-size-monitor-expand"><div class=""></div></div>
                                        <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
                                    </div>
                                    <canvas id="chartjs-pie" style="display: block; width: 723px; height: 252px;" width="723" height="252" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
                labels: ["Social", "Search Engines", "Direct", "Other"],
                datasets: [{
                    data: [260, 125, 54, 146],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger,
                        "#dee2e6"
                    ],
                    borderColor: "transparent"
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                }
            }
        });
    });
</script>

<script>
    function updateScoreColor(score) {
        const scoreElement = document.getElementById('score');
        scoreElement.textContent = score;
        
        if (score < 60) {
            scoreElement.style.color = 'red';
        } else if (score < 75) {
            scoreElement.style.color = 'yellow';
        } else {
            scoreElement.style.color = 'green';
        }
    }
    
    // Example usage:
    updateScoreColor(85);
    </script>
@endpush