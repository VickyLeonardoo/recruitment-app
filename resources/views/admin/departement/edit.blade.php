@extends('partials.admin.header')
@section('content')
    <div class="row">
        <div class="mb-3 text-end">
            <a href="{{ route('admin.departement') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.departement.update', $departement->id) }}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Code</label>
                        <input type="text" name="code"
                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ $departement->code }}"
                            placeholder="Enter Code Departement">
                        @error('code')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $departement->name }}"
                            placeholder="Enter Name Departement">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="submit" class="btn btn-primary form-control" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
