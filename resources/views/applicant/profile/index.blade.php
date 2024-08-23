@extends('partials.applicant.navbar')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.overview') }}" class="nav-link {{ Route::is('applicant.profile.overview') ? 'active' : '' }}" >Overview</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.info') }}" class="nav-link {{ Route::is('applicant.profile.info') ? 'active' : '' }}" >Informasi Pribadi</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.education') }}" class="nav-link {{ Route::is('applicant.profile.education') ? 'active' : '' }}" >Pendidikan</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.experience') }}" class="nav-link {{ Route::is('applicant.profile.experience') ? 'active' : '' }}" >Pengalaman</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.skills') }}" class="nav-link {{ Route::is('applicant.profile.skills') ? 'active' : '' }}" >Keahlian</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('applicant.profile.language') }}" class="nav-link {{ Route::is('applicant.profile.language') ? 'active' : '' }}" >Bahasa Asing</a>
                    </li>

                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active profile-edit pt-3" id="informasi-pribadi">
                        @yield('tab')
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
