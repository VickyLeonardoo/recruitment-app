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
                <a href="{{ route('admin.interview.create') }}" class="btn btn-primary">Add Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Applicant</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($interviews as $int)
                                <tr>
                                    <td>{{ $int->job->code }}</td>
                                    <td>{{ $int->job->position->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($int->date)->format('d F Y') }} @formatTime($int->start_time) -
                                        @formatTime($int->end_time)</td>
                                    <td>
                                        <div class="btn-group dropend mt-1">
                                            @if ($int->status == 'Draft')
                                                <button type="button" class="btn btn-sm text-dark btn-warning" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $int->status }} <i class="fa-solid fa-caret-right"></i>
                                                </button>
                                            @elseif ($int->status == 'Upcoming')
                                                <button type="button" class="btn btn-sm text-dark btn-info" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $int->status }} <i class="fa-solid fa-caret-right"></i>
                                                </button>
                                            @elseif($int->status == 'Done')
                                                <span class="badge badge-sm text-dark bg-success" aria-expanded="false">
                                                    {{ $int->status }} 
                                                </span>
                                            @else
                                                <button type="button" class="btn btn-sm text-dark btn-danger" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $int->status }} <i class="fa-solid fa-caret-right"></i>
                                                </button>
                                            @endif
                                            <ul class="dropdown-menu">
                                                @if ($int->status == 'Draft')
                                                    <li><a class="dropdown-item" href="{{ route('admin.interview.set.upcoming', $int->id) }}">Upcoming</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="showAlert(event, '{{ $int->status }}', {{ $int->id }})">Cancelled</a></li>
                                                @elseif ($int->status == 'Upcoming')
                                                    <li><a class="dropdown-item" href="{{ route('admin.interview.set.draft', $int->id) }}">Draft</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('admin.interview.set.done', $int->id) }}">Done</a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="showAlert(event, '{{ $int->status }}', {{ $int->id }})">Cancelled</a></li>
                                                @elseif ($int->status == 'Cancelled')
                                                    <li><a class="dropdown-item" href="{{ route('admin.interview.set.draft', $int->id) }}">Draft</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.interview.applicant', $int->id) }}"
                                            class="badge bg-info">{{ $int->line->count() }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.interview.edit', $int->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                        <a href="{{ route('admin.interview.destroy', $int->id) }}"
                                            class="btn btn-sm btn-outline-danger">Delete</a>
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
    function showAlert(event, status, id) {
        event.preventDefault(); // Prevent default link action

        if (status === 'Upcoming') {
            Swal.fire({
                title: 'Are you sure?',
                text: "An email will be sent to the applicant, and you can't undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reject it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the route with the specific ID
                    var url = "{{ route('admin.interview.set.cancelled', ':id') }}";
                    url = url.replace(':id', id); // Replace :id with the actual ID
                    window.location.href = url;
                }
            });
        } else {
            // If status is not 'Upcoming', simply navigate to the URL
            var url = "{{ route('admin.interview.set.cancelled', ':id') }}";
            url = url.replace(':id', id); // Replace :id with the actual ID
            window.location.href = url;
        }
    }
</script>
@endpush
