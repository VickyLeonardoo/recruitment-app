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
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.question.create') }}" class="btn btn-primary">Add Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th style="width: 50%">Description</th>
                                {{-- <th style="width: 10%">Difficult</th> --}}
                                <th style="width: 10%">Type</th>
                                {{-- <th style="width: 10%">Status</th> --}}
                                <th style="width: 30%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $q)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $q->description }}</td>
                                    <td>{{ $q->type }}</td>
                                    <td>
                                        <a href="{{ route('admin.question.edit',$q->id) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('admin.question.delete',$q->id) }}" class="btn btn-danger">Delete</a>
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
