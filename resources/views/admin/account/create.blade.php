@extends('partials.admin.header')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            {{-- <li class="breadcrumb-item"><a href="#">{{ Breadcrumbs::render('Add Departement') }}</a></li> --}}
        </ol>
    </nav>
    <div class="row">
        <div class="mb-3">
            <a href="{{ route('admin.account') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div>

        <form action="{{ route('admin.account.store') }}" method="post">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Name</label>
                                <input type="text" name="name" class="form-register" placeholder="Enter Name"></label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Email</label>
                                <input type="text" name="email" class="form-register" placeholder="Enter Name"></label>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="register-label">Departement</label>
                                <select class="form-register {{ $errors->has('departement_id') ? 'is-invalid' : '' }}" id="floatingDept" name="departement_id">
                                    <option value="" selected disabled>Select Departement</option>
                                    @foreach ($departements as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                @error('departement_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="register-label">Position</label>
                                <select class="form-register {{ $errors->has('position_id') ? 'is-invalid' : '' }}" id="floatingPosition" name="position_id" disabled>
                                    <option value="" disabled selected>Select Position</option>
                                </select>
                                @error('position_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="register-label">Role</label>
                                <select class="form-register {{ $errors->has('role_id') ? 'is-invalid' : '' }}" name="role_id">
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">HRD</option>
                                    <option value="3">Manager</option>
                                </select>
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
@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#floatingDept').on('change', function() {
            var deptId = $(this).val();

            if (deptId) {
                $.ajax({
                    url: '/admin/get-positions/' + deptId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#floatingPosition').empty(); // Kosongkan dropdown position
                        $('#floatingPosition').append('<option value="">Select Position</option>');
                        
                        // Iterasi melalui data dan tambahkan option ke dropdown
                        $.each(data, function(id, name) {
                            $('#floatingPosition').append('<option value="' + id + '">' + name + '</option>');
                        });

                        // Aktifkan dropdown position setelah data di-load
                        $('#floatingPosition').prop('disabled', false);
                    }
                });
            } else {
                $('#floatingPosition').empty();
                $('#floatingPosition').append('<option value="">Select Position</option>');
                
                // Nonaktifkan dropdown position jika tidak ada departement yang dipilih
                $('#floatingPosition').prop('disabled', true);
            }
        });
    });
</script>
@endpush
