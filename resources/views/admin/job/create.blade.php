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

        <form action="{{ route('admin.job.store') }}" method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Code</label>
                                        <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                            id="floatingCode" name="code" placeholder="">
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Title</label>
                                        <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                                            id="floatingtitle" name="title" placeholder="">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Description</label>
                                        <textarea name="description" class="form-control" {{ $errors->has('description') ? 'is-invalid' : '' }} id="floatingDesc" placeholder="Description" rows="7"></textarea>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Departement</label>
                                        <select class="form-select {{ $errors->has('departement_id') ? 'is-invalid' : '' }}" id="floatingDept" name="departement_id">
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
                                        <select class="form-select {{ $errors->has('position_id') ? 'is-invalid' : '' }}" id="floatingPosition" name="position_id" disabled>
                                            <option value="" disabled selected>Select Position</option>
                                        </select>
                                        @error('position_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Min Salary</label>
                                        <input type="number" class="form-control {{ $errors->has('min_salary') ? 'is-invalid' : '' }}"
                                            id="floatingMinSalary" name="min_salary" placeholder="">
                                        @error('min_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Max Salary</label>
                                        <input type="number" class="form-control {{ $errors->has('max_salary') ? 'is-invalid' : '' }}"
                                            id="floatingMaxSalary" name="max_salary" placeholder="">
                                        @error('max_salary')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Requirement</label>

                                        <textarea name="requirement" class="form-control" {{ $errors->has('description') ? 'is-invalid' : '' }}  placeholder="requirement" rows="7"></textarea>
                                        
                                        @error('requirement')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Qualification</label>
                                        <textarea name="qualification" class="form-control" {{ $errors->has('qualification') ? 'is-invalid' : '' }} placeholder="Qualification" rows="7"></textarea>
                                        @error('qualification')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Type</label>
                                        <select class="form-select {{ $errors->has('type') ? 'is-invalid' : '' }}" id="floatingType" name="type">
                                            <option value="" selected disabled>Select Type</option>
                                            <option value="Full Time">Full Time</option>
                                            <option value="Part Time">Part Time</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">Start Date</label>
                                        <input type="date" class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}"
                                            id="floatingStartDate" name="start_date" placeholder="">
                                        @error('start_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                    <div class="form-group mb-3">
                                        <label for="" class="register-label">End Date</label>
                                        <input type="date" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}"
                                            id="floatingEndDate" name="end_date" placeholder="">
                                        @error('end_date')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
        
                                   
                                </div>
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
