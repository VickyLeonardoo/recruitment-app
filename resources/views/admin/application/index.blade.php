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
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Reg Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ordep</td>
                                <td>01 Januari 2024</td>
                                <th><span class="badge bg-success">Ongoing</span></th>
                                <th>
                                    <a href="{{ route('admin.application.profile',[1,1]) }}" class="btn btn-primary">View Profile</a>
                                    <a href="{{ route('admin.application.result',[1,1]) }}" class="btn btn-info">Result Test</a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
