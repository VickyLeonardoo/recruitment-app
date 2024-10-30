@extends('partials.admin.header')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
        </ol>
    </nav>
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('admin.account') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('admin.account.update.password') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Password</label>
                                <input type="password" name="password" class="form-register" placeholder="Enter Password"
                                    value="">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Password Confirmation</label>
                                <input type="password" name="password_confirmation" class="form-register" placeholder="Enter Password"
                                    value="">
                                @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary " value="Update Password">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection