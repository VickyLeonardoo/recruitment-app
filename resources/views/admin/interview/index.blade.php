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
            <a href="{{ route('admin.departement.create') }}" class="btn btn-primary">Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th style="width: 10%">Code</th>
                            <th style="width: 40%">Name</th>
                            <th style="width: 20%"></th>
                            <th style="width: 30%">Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
