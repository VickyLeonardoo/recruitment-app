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
            <div class="mb-3 d-flex justify-content-between">
                <div>
                    <a href="{{ route('admin.interview.generate.applicant',$schedule->id) }}" class="btn btn-secondary">Generate List</a>
                    <a href="{{ route('admin.interview.applicant.mail',$schedule->id) }}" class="ml-3 btn btn-primary"><i class="fas fa-envelope"></i> Sent Mail</a>
                </div>
                <div>
                    <a onclick="rejectSelected()" class="ml-3 btn btn-danger">Reject</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="example" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" style="transform: scale(1.5);" onclick="toggleCheckboxes(this)"></th>
                            <th>Reg No</th>
                            <th>Name</th>
                            <th class="text-center">Marked</th>
                            <th class="text-center">Mailed</th>
                            <th>Status</th>
                            <th></th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedule->line as $ln)
                            <tr>
                                <td><input type="checkbox" class="application-checkbox" value="{{ $ln->id }}" style="transform: scale(1.5);"></td>
                                <td>{{ $ln->application->reg_no }}</td>
                                <td>{{ $ln->application->user->user_detail->full_name }}</td>
                                <td class="text-center"><input type="checkbox" onclick="return false" {{ $ln->is_marked == true ? 'checked':'' }} style="transform: scale(1.5);"></td>
                                <td class="text-center">
                                    <input type="checkbox"  onclick="return false" {{ $ln->is_email == true ? 'checked':'' }} style="transform: scale(1.5);">
                                </td>
                                <td>
                                    @if ($ln->result == 'Pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($ln->result == 'Approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($ln->result == 'Rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.interview.applicant.detail',[ $schedule->id,$ln->application->id]) }}" class="btn btn-outline-primary btn-sm">Applicant Detail</a>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function toggleCheckboxes(source) {
        checkboxes = document.querySelectorAll('input[type="checkbox"].application-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    function rejectSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value); // asumsikan value checkbox adalah application ID
        });

        if (selected.length > 0) {
            // Redirect ke route yang ditentukan dengan query parameters
            var url = "{{ route('admin.interview.applicant.reject', ':ids') }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            // Menampilkan SweetAlert jika tidak ada aplikasi yang dipilih
            Swal.fire({
                title: 'No Application Selected',
                text: 'Choose at least one application to perform this action.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    }
</script>
@endpush