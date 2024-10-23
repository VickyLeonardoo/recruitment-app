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
                <a href="{{ route('admin.account.create') }}" class="btn btn-primary">Add Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Departement</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->departement->name }}</td>
                                    <td>{{ $staff->role->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.account.update.status',$staff->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" value="{{ $staff->is_active == 0 ? 'Inacitve':'Active' }}" class="btn btn-sm {{ $staff->is_active == 0 ? 'btn-danger':'btn-success' }}" name="status">
                                        </form>
                                        {{-- <a href="" class="badge {{ $staff->is_active == 0 ? 'bg-dager':'bg-success' }}">{{ $staff->is_active == 0 ? 'Inacitve':'Active' }}</a> --}}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.account.edit',$staff->id) }}" class="text-white btn bg-info">Edit</a>
                                        <a href="{{ route('admin.account.delete',$staff->id) }}" class="text-white btn bg-danger">Delete</a>
                                        <a href="" class="text-white btn bg-warning"><i class="fas fa-archive"></i></a>
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
