@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th>Code</th>          
                                <th>Departement</th>          
                                <th>Position</th>          
                                <th>Status</th>          
                                <th class="text-center">Batas Pelamar</th>          
                                <th></th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->code }}</td>
                                    <td>{{ $job->departement->name }}</td>
                                    <td>{{ $job->position->name }}</td>
                                    <td>{{ $job->status }}</td>
                                    <td class="text-center"><span class="badge bg-primary">{{ $job->max_pax }}</span></td>
                                    <td class="text-center">
                                        @if ($job->application->count() < $job->max_pax)
                                            <a class="btn btn-secondary mt-3" href="{{ route('applicant.job.detail', $job->code) }}">Detail</a>
                                        @else
                                            <strong>Penuh</strong>
                                        @endif
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