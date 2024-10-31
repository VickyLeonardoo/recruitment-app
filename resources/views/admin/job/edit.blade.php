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

        <form action="{{ route('admin.job.update', $job->id) }}" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Code</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                            id="floatingCode" name="code" value="{{ $job->code }}">
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Title</label>
                                        <input type="text"
                                            class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            id="floatingtitle" name="title" value="{{ $job->title }}">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Description</label>
                                        <textarea name="description" class="form-control" {{ $errors->has('description') ? 'is-invalid' : '' }}
                                            id="floatingDesc" placeholder="Description" rows="7">{{ $job->description }}</textarea>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Department</label>
                                        <select
                                            class="form-select {{ $errors->has('departement_id') ? 'is-invalid' : '' }}"
                                            id="floatingDept" name="departement_id">
                                            <option value="" disabled>Select Department</option>
                                            @foreach ($departements as $dept)
                                                <option value="{{ $dept->id }}"
                                                    {{ $job->departement_id == $dept->id ? 'selected' : '' }}>
                                                    {{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('departement_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Position</label>
                                        <select class="form-select {{ $errors->has('position_id') ? 'is-invalid' : '' }}"
                                            id="floatingPosition" name="position_id">
                                            <option value="" disabled>Select Position</option>
                                        </select>
                                        @error('position_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Min Salary</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('min_salary') ? 'is-invalid' : '' }}"
                                            id="floatingMinSalary" name="min_salary" value="{{ $job->min_salary }}"
                                            placeholder="">
                                        @error('min_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Max Salary</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('max_salary') ? 'is-invalid' : '' }}"
                                            id="floatingMaxSalary" name="max_salary" value="{{ $job->max_salary }}"
                                            placeholder="">
                                        @error('max_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Requirement</label>
                                        <textarea name="requirement" class="form-control" {{ $errors->has('description') ? 'is-invalid' : '' }}
                                            placeholder="requirement" rows="7">{{ $job->requirement }}</textarea>

                                        @error('requirement')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Qualification</label>
                                        <textarea name="qualification" class="form-control" {{ $errors->has('qualification') ? 'is-invalid' : '' }}
                                            placeholder="Qualification" rows="5">{{ $job->qualification }}</textarea>
                                        @error('qualification')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Type</label>
                                        <select class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}"
                                            id="floatingType" name="type">
                                            <option value="" disabled>Select Type</option>
                                            <option value="Full Time" {{ $job->type == 'Full Time' ? 'selected' : '' }}>
                                                Full Time</option>
                                            <option value="Part Time" {{ $job->type == 'Part Time' ? 'selected' : '' }}>
                                                Part Time</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Start Date</label>
                                        <input type="date"
                                            class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                            id="floatingStartDate" name="start_date" value="{{ $job->start_date }}">
                                        @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">End Date</label>
                                        <input type="date"
                                            class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                            id="floatingEndDate" name="end_date" value="{{ $job->end_date }}">
                                        @error('end_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Max Applicant</label>
                                        <input type="number"
                                            class="form-control {{ $errors->has('max_pax') ? 'is-invalid' : '' }}"
                                            id="floatingMaxSalary" name="max_pax" placeholder=""
                                            value="{{ $job->max_pax }}">
                                        @error('max_pax')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary form-control-lg form-control"
                                    value="Save">
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
            var initialPositionId = {{ $job->position_id ?? 'null' }};
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
