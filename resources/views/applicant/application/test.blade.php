@extends('partials.applicant.navbar')

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                @foreach ($tests as $test)
                <p>
                    {{ $test->question->description }}
                </p>
                @endforeach
            </div>
        </div>
    </div>
@endsection