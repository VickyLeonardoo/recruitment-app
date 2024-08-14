@extends('partials.admin.header')
@section('content')
    <div class="row">
        {{-- <div class="mb-3 text-end" style="margin-left: -10px">
            <a href="{{ route('admin.departement') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div> --}}
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
                    <div class="alert alert-primary" role="alert">
                        {{ $departements->name }}
                    </div>
                    <a href="{{ route('admin.position.create', $departements->slug) }}" class="btn btn-primary">Add Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="example" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th style="width: 10%">Code</th>
                                    <th style="width: 50%">Name</th>
                                    <th style="width: 30%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departements->position as $position)
                                    <tr>
                                        <td>{{ $position->id }}</td>
                                        <td>{{ $position->code }}</td>
                                        <td>{{ $position->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.position.edit', ['slug' => $departements->slug, 'id' => $position->id]) }}"
                                                class="btn btn-outline-primary">Edit</a>
                                            <a href="{{ route('admin.position.delete', $position->id) }}"
                                                class="btn btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
