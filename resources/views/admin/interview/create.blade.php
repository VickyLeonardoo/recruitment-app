@extends('partials.admin.header')
@section('content')
    <div class="row">
        {{-- <div class="mb-3">
            <a href="{{ route('admin.position') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div> --}}

        <form action="" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Job Vacancy:</label>
                                    <select id="clearButton" name="job_vacancy_id" placeholder="Select an option...">
                                        @foreach ($jobs as $job)
                                            <option value="{{$job->id}}">{{ $job->code }} | {{ $job->position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Date</label>
                                    <input type="date" name="date" class="form-control" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Start Time</label>
                                    <input type="time" name="start_time" class="form-control" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">End Time</label>
                                    <input type="time" name="end_time" class="form-control" value="">
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#clearButton").selectize({
                plugins: ["clear_button"],
            });
        });
    </script>
@endpush
