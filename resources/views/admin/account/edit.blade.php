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

        <form action="{{ route('admin.account.update',$staff->id) }}" method="post">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Name</label>
                                <input type="text" name="name" class="form-register" placeholder="Enter Name"
                                    value="{{ $staff->name }}">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Email</label>
                                <input type="text" name="email" class="form-register" placeholder="Enter Name"
                                    value="{{ $staff->email }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="register-label">Department</label>
                                <select class="form-select {{ $errors->has('departement_id') ? 'is-invalid' : '' }}" id="floatingDept" name="departement_id">
                                    <option value="" disabled>Select Department</option>
                                    @foreach ($departements as $dept)
                                    <option value="{{ $dept->id }}" {{ $staff->departement_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                @error('departement_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="" class="register-label">Position</label>
                                <select class="form-select {{ $errors->has('position_id') ? 'is-invalid' : '' }}" id="floatingPosition" name="position_id">
                                    <option value="" disabled>Select Position</option>
                                </select>
                                @error('position_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="register-label">Role</label>
                                <select class="form-register {{ $errors->has('role_id') ? 'is-invalid' : '' }}"
                                    name="role_id">
                                    <option value="" disabled>Select Role</option>
                                    <option value="1" {{ $staff->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ $staff->role_id == 2 ? 'selected' : '' }}>HRD</option>
                                    <option value="3" {{ $staff->role_id == 3 ? 'selected' : '' }}>Manager</option>
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
            function loadPositions(deptId, selectedPositionId = null) {
                if (deptId) {
                    $.ajax({
                        url: '/admin/get-positions/' + deptId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#floatingPosition').empty();
                            $('#floatingPosition').append('<option value="">Select Position</option>');

                            $.each(data, function(id, name) {
                                var selected = (id == selectedPositionId) ? 'selected' : '';
                                $('#floatingPosition').append('<option value="' + id + '" ' +
                                    selected + '>' + name + '</option>');
                            });

                            $('#floatingPosition').prop('disabled', false);
                        }
                    });
                } else {
                    $('#floatingPosition').empty();
                    $('#floatingPosition').append('<option value="">Select Position</option>');
                    $('#floatingPosition').prop('disabled', true);
                }
            }

            // Load positions on page load
            var initialDeptId = $('#floatingDept').val();
            var initialPositionId = {{ $staff->position_id ?? 'null' }};
            if (initialDeptId) {
                loadPositions(initialDeptId, initialPositionId);
            }

            // Load positions on department change
            $('#floatingDept').on('change', function() {
                var deptId = $(this).val();
                loadPositions(deptId);
            });
        });
    </script>
@endpush
