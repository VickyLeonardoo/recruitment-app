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
                <a href="{{ route('admin.job.create') }}" class="btn btn-primary">Add Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Departemen</th>
                                <th>Position</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Applicant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->code }}</td>
                                    <td>{{ $job->departement->name }}</td>
                                    <td>{{ $job->position->name }}</td>
                                    <td>{{ $job->type }}</td>
                                    <td>@formatDate($job->startDate)</td>
                                    <td>@formatDate($job->endDate)</td>
                                    <td><a class="badge {{ $job->status == 'Active' ? 'bg-success' : 'bg-danger' }}">{{ $job->status == 'Active' ? 'Active' : 'Inactive' }}</a></td>
                                    <td><a href="{{ route('admin.application',$job->id) }}" class="badge bg-info">{{ $job->application->count() }}</a></td>
                                    <td>
                                        <a href="{{ route('admin.job.edit',$job->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.job.delete',$job->id) }}" class="btn btn-danger">Delete</a>
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
