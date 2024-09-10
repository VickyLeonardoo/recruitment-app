@extends('partials.applicant.navbar')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    @foreach ($tests as $index => $test)
                        <div class="mb-4">
                            <p><strong>{{ $index + 1 }}. {{ $test->question->description }}</strong></p>
                            @foreach ($test->question->choices as $choice)
                                <div class="form-check">
                                    <input class="form-check-input answer-choice" 
                                        type="radio" 
                                        name="answers[{{ $test->question->id }}]" 
                                        value="{{ $choice->id }}" 
                                        data-question-id="{{ $test->question->id }}" 
                                        data-test-id="{{ $test->test_id }}" 
                                        id="choice_{{ $choice->id }}" 
                                        {{ $test->choice_id == $choice->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="choice_{{ $choice->id }}">
                                        {{ $choice->label }}. {{ $choice->choice }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <form action="{{ route('applicant.application.submit', $test->test_id) }}" method="POST">
                        @csrf
                        <div class="col-lg-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary text-white">Submit Jawaban</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div id="question-numbers">
                    @foreach ($tests as $index => $test)
                        <div class="question-box" id="question_{{ $test->question->id }}">
                            {{ $index + 1 }}
                        </div>
                    @endforeach
                </div>
                <div id="timer"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        // Mengambil start_time dari controller
        var startTime = new Date("{{ $start_time }}").getTime(); 
        var currentTime = new Date().getTime(); 
        var endTime = startTime + 30 * 60 * 1000; // 30 menit setelah start_time

        function startTimer() {
            var now = new Date().getTime();
            var distance = endTime - now;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("timer").innerHTML = "Time's up!";
                $('.answer-choice').attr('disabled', true); // Menonaktifkan input jawaban
            }
        }

        // Periksa apakah waktu sudah habis
        if (currentTime > endTime) {
            document.getElementById("timer").innerHTML = "Time's up!";
            $('.answer-choice').attr('disabled', true); // Menonaktifkan input jawaban
        } else {
            // Mulai timer
            var x = setInterval(startTimer, 1000); // Update setiap detik
        }

        // Update warna nomor soal ketika jawaban dipilih
        $('.answer-choice').on('change', function() {
            var questionId = $(this).data('question-id');
            var testId = $(this).data('test-id');
            var choiceId = $(this).val();

            // Mengirim jawaban melalui AJAX
            $.ajax({
                url: '{{ route("applicant.application.test.saveAnswer") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    question_id: questionId,
                    test_id: testId,
                    choice_id: choiceId
                },
                success: function(response) {
                    if (response.success) {
                        // Update warna ke hijau jika jawaban tersimpan
                        $('#question_' + questionId).addClass('answered'); // Menggunakan kelas CSS
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        // Update kotak soal yang sudah dijawab jika ada
        $('.answer-choice:checked').each(function() {
            var questionId = $(this).data('question-id');
            $('#question_' + questionId).addClass('answered');
        });
    });
</script>
@endpush