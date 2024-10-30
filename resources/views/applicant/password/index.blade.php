@extends('partials.applicant.navbar')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6"> <!-- Mengatur lebar card menjadi setengah dari layar di ukuran medium ke atas -->
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('applicant.password.update') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">New Password</label>
                        <input type="password" class="onlybottom" placeholder="" value="" name="password">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Confirmation Password</label>
                        <input type="password" class="onlybottom" placeholder="" value="" name="confirmation_password">
                        @error('confirmation_password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection