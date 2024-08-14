@extends('partials.admin.header')
@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('Add Departement') }}</a></li>
        </ol>
    </nav>
    <div class="row">
        <div class="mb-3">
            <a href="{{ route('admin.departement') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('admin.departement.store') }}" method="post">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="floatingCode" name="code" placeholder="">
                                <label for="floatingCode">Code Departement</label>
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="floatingName" name="name" placeholder="">
                                <label for="floatingName">Name Departement</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary form-control-lg form-control" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @csrf
        </form>
    </div>
@endsection
