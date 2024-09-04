@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th></th>           
                                <th>Nomor Lamaran</th>          
                                <th>Nomor Pekerjaan</th>          
                                <th>Tanggal Melamar</th>          
                                <th>Status</th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apps as $apl)
                                <tr>
                                    <td>
                                        <a href="{{ route('applicant.application.detail', $apl->id) }}" class="btn btn-dark text-white">Detail</a>
                                    </td>
                                    <td>{{ $apl->reg_no }}</td>
                                    <td>{{ $apl->job?->code ?? 'N/A' }}</td>
                                    <td>{{ $apl->created_at }}</td>
                                    <td>{{ $apl->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection