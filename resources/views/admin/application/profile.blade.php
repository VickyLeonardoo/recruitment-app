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
                                                <p class="mb-3">user1@example.com</p>
                                                <p class="register-label">Tanggal Lahir</p>
                                                <p class="mb-3">
                                                    04 Sep 2001
                                                    (23 Tahun)
                                                </p>
                                                <p class="register-label">Jenis Kelamin</p>
                                                <p class="mb-3">male</p>
                                                <p class="register-label">Kota</p>
                                                <p class="mb-3">Batam</p>

                                            </div>
                                            <div class="col-md-6">
                                                <p class="register-label">Nama Lengkap: </p>
                                                <p class="mb-3">Vicky Leonardo Manurung</p>
                                                <p class="register-label">Agama</p>
                                                <p class="mb-3">kristen</p>
                                                <p class="register-label">Status</p>
                                                <p class="mb-3">Belum Menikah</p>
                                                <p class="register-label">Kewarganegaraan</p>
                                                <p class="mb-3">Singapore</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseTwo">
                                        Pendidikan
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                    style="">
                                    <div class="accordion-body">
                                        <p class="text-center"><i>Tidak ada data pendidikan</i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseThree">
                                        Pengalaman Kerja
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                    style="">
                                    <div class="accordion-body">
                                        <p class="text-center"><i>Tidak ada data pengelaman bekerja</i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseFour">
                                        Keahlian
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse show"
                                    style="">
                                    <div class="accordion-body">
                                        <p class="text-center"><i>Tidak ada data keahlian</i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true"
                                        aria-controls="panelsStayOpen-collapseFive">
                                        Bahasa Asing
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse show"
                                    style="">
                                    <div class="accordion-body">
                                        <p class="text-center"><i>Tidak ada data keahlian bahasa asing</i></p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="text-center">
                            <img src="https://8000-idx-recruitment-app-1723089168321.cluster-a3grjzek65cxex762e4mwrzl46.cloudworkstations.dev/storage/profile-picture/1725430846.jpg"
                                class="img-fluid" id="filePreview">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
