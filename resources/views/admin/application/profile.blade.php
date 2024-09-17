@extends('partials.admin.header')
@section('content')

    <div class="row">
        @if ($apl->is_recomended == 1)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Recommendation!</strong>.
        </div>
        @endif
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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseOne">
                                        Informasi Pribadi
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="register-label">Email</p>
                                                <p class="mb-3">{{ $user->email }}</p>
                                                <p class="register-label">Tanggal Lahir</p>
                                                <p class="mb-3"> 
                                                    {{ Carbon\Carbon::parse($user->user_detail->dob)->format('d M Y') }}
                                                    ({{ \Carbon\Carbon::parse($user->user_detail->dob)->age }} Tahun)
                                                </p>
                                                <p class="register-label">Jenis Kelamin</p>
                                                <p class="mb-3">{{ $user->user_detail->gender }}</p>
                                                <p class="register-label">Kota</p>
                                                <p class="mb-3">{{ $user->user_detail->city }}</p>
            
                                            </div>
                                            <div class="col-md-6">
                                                <p class="register-label">Nama Lengkap: </p>
                                                <p class="mb-3">{{ $user->user_detail->full_name }}</p>
                                                <p class="register-label">Agama</p>
                                                <p class="mb-3">{{ $user->user_detail->religion }}</p>
                                                <p class="register-label">Status</p>
                                                <p class="mb-3">{{ $user->user_detail->status }}</p>
                                                <p class="register-label">Kewarganegaraan</p>
                                                <p class="mb-3">{{ $user->user_detail->nationality }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        Pendidikan
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @forelse ($user->education_details as $edu)
                                            <li>{{ $edu->degree }} {{ $edu->major }} - {{ $edu->university }}</li>
                                        @empty
                                            <p class="text-center"><i>Tidak ada data pendidikan</i></p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        Pengalaman Kerja
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @forelse ($user->experience_details as $exp)
                                            <li>{{ $exp->company_name }} - {{ $exp->designation }}</li>
                                        @empty
                                            <p class="text-center"><i>Tidak ada data pengelaman bekerja</i></p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFour">
                                        Keahlian
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @forelse ($user->skill_details as $skill)
                                            <li>{{ $skill->name }}</li>
                                        @empty
                                            <p class="text-center"><i>Tidak ada data keahlian</i></p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                                        aria-controls="panelsStayOpen-collapseFive">
                                        Bahasa Asing
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        @forelse ($user->language_details as $lang)
                                            <li>{{ $lang->language->name }}</li>
                                        @empty
                                            <p class="text-center"><i>Tidak ada data keahlian bahasa asing</i></p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-header">
                            <h4 class="card-title">Profile Picture</h4>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    @if ($user->user_detail)
                                        @if ($user->user_detail->profile_picture)
                                            <img src="{{ asset('storage/profile-picture/' . $user->user_detail->profile_picture) }}"
                                                class="img-fluid" id="filePreview">
                                        @else
                                            <img src="{{ asset('img/no_image.jpg') }}" alt="" class="img-fluid"
                                                id="filePreview">
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <h1 class="h3 mb-0"><strong>TEST RESULT</strong></h1>
    <div class="row mt-3">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Score</h5>
                    <h6 class="card-subtitle text-muted">Your current score is displayed below.</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center" style="height: 252px;">
                        <h1 id="score" style="font-size: 6rem;">{{ $grade }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Statistik Jawaban</h5>
                    {{-- <h6 class="card-subtitle text-muted">Pie charts are excellent at showing the relational proportions between data.</h6> --}}
                </div>
                <div class="card-body">
                    <div class="chart chart-sm">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('admin.application.recomendation', $apl->id) }}">
            @csrf
            <button type="submit" class="btn {{ $apl->is_recomended == '0' ? 'btn-primary' : 'btn-danger' }}"></i>{{ $apl->is_recomended == '0' ? 'Recommendation':'Cancel Recommendation' }}</button>
        </form>
    </div>
@endsection
@push('js')
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endpush
