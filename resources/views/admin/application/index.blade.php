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
                            @foreach ($jobs->application as $apl)
                                <tr>
                                    <td>{{ $apl->reg_no }}</td>
                                    <td>{{ $apl->user->user_detail->full_name }}</td>
                                    <th>

                                        <!-- Default dropend button -->
                                        <div class="btn-group dropend mt-1">
                                            @if ($apl->status == 'Rejected')
                                            <button type="button" class="btn btn-sm text-dark btn-danger"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @elseif ($apl->status == 'Pending')
                                            <button type="button" class="btn btn-sm text-dark btn-warning"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @elseif($apl->status == 'Interview')
                                            <button type="button" class="btn btn-sm text-dark btn-info"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-sm text-dark btn-success"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @endif
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">Reject</a></li>
                                                <li><a class="dropdown-item" href="#">Pending</a></li>
                                                <li><a class="dropdown-item" href="#">Approve</a></li>
                                                <li><a class="dropdown-item" href="#">Interview</a></li>
                                            </ul>
                                        </div>
                                    </th>
                                    <th>
                                        <a href="{{ route('admin.application.profile', [1, 1]) }}"
                                            class="btn btn-primary">View Profile</a>
                                        <a href="{{ route('admin.application.result', [1, 1]) }}" class="btn btn-info">Result
                                            Test</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
