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
            <a href="{{ route('admin.interview.create') }}" class="btn btn-primary">Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example" width="100%">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Position</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Applicant</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interviews as $int)
                            <tr>
                                <td>{{ $int->job->code }}</td>
                                <td>{{ $int->job->position->name }}</td>
                                <td>{{ Carbon\Carbon::parse($int->date)->format('d F Y') }} @formatTime($int->start_time) - @formatTime($int->end_time)</td>
                                <td>{{ $int->status }}</td>
                                <td>
                                    <a href="{{ route('admin.interview.applicant',$int->id) }}" class="badge bg-info">{{ $int->line->count() }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.interview.edit',$int->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <a href="{{ route('admin.interview.destroy',$int->id) }}" class="btn btn-sm btn-outline-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
