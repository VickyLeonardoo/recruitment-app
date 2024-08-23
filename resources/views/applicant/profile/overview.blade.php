@extends('applicant.profile.index')
@section('tab')
    @if ($user->user_detail)
        @if (!$user->user_detail->profile_picture)
            <div class="alert alert-danger" role="alert">
                Perhatian! Kamu belum mengupload foto profile
            </div>
        @endif
    @endif
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
            {{-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi Pribadi</h4>
                </div>
                <div class="card-body">
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
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pendidikan</h4>
                </div>
                <div class="card-body">
                    @forelse ($user->education_details as $edu)
                        <li>{{ $edu->degree }} {{ $edu->major }} - {{ $edu->university }}</li>
                    @empty
                        <p class="text-center"><i>Tidak ada data pendidikan</i></p>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pengalaman Bekerja</h4>
                </div>
                <div class="card-body">
                    @forelse ($user->experience_details as $exp)
                        <li>{{ $exp->company_name }} - {{ $exp->designation }}</li>
                    @empty
                        <p class="text-center"><i>Tidak ada data pengelaman bekerja</i></p>
                    @endforelse
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Keahlian</h4>
                </div>
                <div class="card-body">
                    @forelse ($user->skill_details as $skill)
                        <li>{{ $skill->name }}</li>
                    @empty
                        <p class="text-center"><i>Tidak ada data keahlian</i></p>
                    @endforelse
                </div>
            </div> --}}
        </div>
        <div class="col-lg-4">
            <div class="card-header">
                <h4 class="card-title">Profile Picture</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('applicant.profile.picture') }}" method="post" enctype="multipart/form-data"
                        class="mb-3">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="file" name="profile_picture" class="onlybottom" id="fileInput"
                                accept="image/png, image/gif, image/jpeg">
                            @error('profile_picture')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">

                            <button type="submit" class="btn btn-outline-danger btn-icon-text">
                                <i class="ti-upload btn-icon-prepend"></i>
                                Upload
                            </button>
                        </div>
                    </form>
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
@endsection
@push('js')
    <script>
        document.getElementById('fileInput').onchange = function(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('filePreview');
                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endpush
