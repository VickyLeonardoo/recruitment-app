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
                {{-- <a href="{{ route('admin.job.create') }}" class="btn btn-primary">Add Data</a> --}}
            </div> 
            <div class="card-body">
                <div class="mb-3 d-flex justify-content-between">
                    <div>
                        <button class="btn btn-primary" onclick="markSelected()">MARK</button>
                        <button class="btn btn-warning" onclick="unmarkSelected()">UNMARK</button>
                        <button class="btn btn-success" onclick="interviewSelected()">INTERVIEW</button>

                    </div>
                    <div>
                        <button class="btn btn-danger" onclick="rejectSelected()">Reject</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="application" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" style="transform: scale(1.5);" onclick="toggleCheckboxes(this)"></th>
                                <th>Name</th>
                                <th>Reg Date</th>
                                <th>Status</th>
                                <th class="text-center">Recomendation</th>
                                <th class="text-center">Mark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs->application as $apl)
                                <tr>
                                    <td><input type="checkbox" class="application-checkbox" value="{{ $apl->id }}" style="transform: scale(1.5);"></td>
                                    <td>{{ $apl->reg_no }}</td>
                                    <td>{{ $apl->user->user_detail->full_name }}</td>
                                    <td>

                                        <!-- Default dropend button -->
                                        <div class="btn-group dropend mt-1">
                                            @if ($apl->status == 'Rejected')
                                            <button type="button" class="btn btn-sm text-dark btn-danger" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @elseif ($apl->status == 'Pending')
                                            <button type="button" class="btn btn-sm text-dark btn-warning" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @elseif($apl->status == 'Interview')
                                            <button type="button" class="btn btn-sm text-dark btn-info" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-sm text-dark btn-success" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $apl->status }} <i class="fa-solid fa-caret-right"></i>
                                            </button>
                                            @endif
                                            <ul class="dropdown-menu">
                                                @if ($apl->status != 'Rejected')
                                                <li><a class="dropdown-item" href="{{ route('admin.application.reject', $apl->id) }}">Reject</a></li>
                                                @endif
                                                @if ($apl->status != 'Pending')
                                                <li><a class="dropdown-item" href="{{ route('admin.application.pending', $apl->id) }}">Pending</a></li>
                                                @endif
                                                @if ($apl->status != 'Approved')
                                                <li><a class="dropdown-item" href="{{ route('admin.application.approved', $apl->id) }}">Approve</a></li>
                                                @endif
                                                @if ($apl->status != 'Interview')
                                                <li><a class="dropdown-item" href="{{ route('admin.application.interview', $apl->id) }}">Interview</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" {{ $apl->is_recomended ? 'checked' : '' }} style="transform: scale(1.5);" onclick="return false">
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" {{ $apl->is_mark ? 'checked' : '' }} style="transform: scale(1.5);">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.application.profile', [$jobs->id, $apl->id]) }}"
                                            class="btn btn-primary">Detail Applicant</a>
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
    // Select/Deselect all checkboxes
    function toggleCheckboxes(source) {
        checkboxes = document.querySelectorAll('input[type="checkbox"].application-checkbox');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = source.checked;
        }
    }

    // Collect IDs of selected applications
    function markSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value); // asumsikan value checkbox adalah application ID
        });

        if (selected.length > 0) {
            // Redirect ke route yang ditentukan dengan query parameters
            var url = "{{ route('admin.application.mark', ':ids') }}";
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

    function unmarkSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value); // assuming checkbox value is application ID
        });
        
        if (selected.length > 0) {
            // Redirect to the named route with selected IDs as query parameters
            var url = "{{ route('admin.application.unmark', ':ids') }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            Swal.fire({
                title: 'No Application Selected',
                text: 'Choose at least one application to perform this action.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    }

    function interviewSelected(){
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value); // assuming checkbox value is application ID
        });
        
        if (selected.length > 0) {
            // Redirect to the named route with selected IDs as query parameters
            var url = "{{ route('admin.application.mass.interview', ':ids') }}";
            url = url.replace(':ids', selected.join(','));
            window.location.href = url;
        } else {
            Swal.fire({
                title: 'No Application Selected',
                text: 'Choose at least one application to perform this action.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    }

    function rejectSelected() {
        var selected = [];
        document.querySelectorAll('input[type="checkbox"].application-checkbox:checked').forEach(function(checkbox) {
            selected.push(checkbox.value); // asumsikan value checkbox adalah application ID
        });

        if (selected.length > 0) {
            // Tampilkan SweetAlert untuk konfirmasi
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, redirect ke route Laravel
                    var url = "{{ route('admin.application.mass.reject', ':ids') }}";
                    url = url.replace(':ids', selected.join(','));
                    window.location.href = url;
                }
            });
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
