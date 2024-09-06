@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="row px-5 padding-size">
            <div class="col-lg-4 col-12 border-end-desktop">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-muted text-center">
                            {{ $job->departement->name }}
                        </h3>
                    </div>
                </div>
                <div class="row mt-lg-5 mt-2">
                    <div class="col-12 border-top">
                        <p class="font-14 text-muted mb-0 mt-3">Position</p>
                        <p class="font-14">{{ $job->position->name }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 border-top">
                        <p class="font-14 text-muted mb-0 mt-3">Tipe</p>
                        <p class="font-14">{{ $job->type }}</p>
                    </div>
                </div>

            </div>
            <div class="col-lg-8 col-12 p-lg-5 pt-2">
                <div class="row">
                    <div class="col-12">
                        <p>Gambaran Pekerjaan</p>
                        <div>{!! nl2br(e($job->description)) !!}
                        </div>
                        <br><br>
                        <p>Kualifikasi</p>
                        <ul>
                            {!! nl2br(e($job->qualification)) !!}
                            
                        </ul>
                        <br><br>
                        <p>Skill yang Dibutuhkan</p>
                        <ul>
                            {!! nl2br(e($job->requirement)) !!}
                        </ul>

                    </div>
                </div>

                @if ($is_applied == false)
                <div class="row">
                    <form action="{{ route('applicant.job.apply',$job->id) }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-dark text-white" value="Lamar Cepat">
                    </form>
                </div>
                @else
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Kamu sudah mendaftar</strong>.
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
