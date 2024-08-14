@extends('partials.admin.header')
@section('content')
    <div class="row">
        {{-- <div class="mb-3">
            <a href="{{ route('admin.position') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div> --}}

        <form action="{{ route('admin.position.store',$departements->slug) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" id="floatingCode" name="code" placeholder="">
                                <label for="floatingCode">Code Position</label>
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
        
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="floatingName" name="name" placeholder="">
                                <label for="floatingName">Name Position</label>
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
        </form>
    </div>
@endsection
