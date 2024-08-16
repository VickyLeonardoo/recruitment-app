@extends('partials.admin.header')
@section('content')
    <div class="row">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="text-end">
                            <a href="{{ route('admin.question.edit', $question->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                        </div>
                        <div class="form-group mb-3">
                            <label for=""><strong>Type</strong></label>
                            <input type="text" value="{{ $question->type }}" readonly
                                class="form-control-lg form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for=""><strong>Description*</strong></label>
                            <textarea name="description" rows="3" readonly
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $question->description }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for=""><strong>Difficult</strong></label>
                            <input type="text" value="{{ $question->difficult }}" readonly
                                class="form-control-lg form-control">
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Answer</h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">Label</th>
                                            <th style="width: 50%">Answer</th>
                                            <th style="width: 20%">Status</th>
                                            <th style="width: 20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($question->choices as $choice)
                                            <tr>
                                                <td>{{ $choice->label }}</td>
                                                <td>{{ $choice->choice }}</td>
                                                <td>
                                                    @if ($choice->is_corect)
                                                        <span class="badge bg-success">Correct</span>
                                                    @else
                                                        <span class="badge bg-danger">Incorrect</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $choice->id }}">
                                                        Edit
                                                    </button>
                                                    <a href="{{ route('admin.choice.delete', $choice->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">No Answer Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Preview Image</h4>
                                <hr>
                            </div>
                            <div class="card-body text-center">
                                @if ($question->image)
                                    <img src="{{ asset('storage/question/' . $question->image) }}" class="img-fluid" id="filePreview">
                                @else
                                    <img src="{{ asset('img/no_image.jpg') }}" class="img-fluid" id="filePreview">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Answer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form action="{{ route('admin.choice.store', $question->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for=""><strong>Label</strong></label>
                                    <input type="text" name="label" class="form-control"
                                        value="{{ old('label') }}">
                                    @error('label')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Answer Type</strong></label><br>
                                    <input type="radio" name="answer_type" value="text" id="answerTypeText"
                                        {{ old('answer_type') == 'text' ? 'checked' : '' }}> Text
                                    <input type="radio" name="answer_type" value="image" id="answerTypeImage"
                                        {{ old('answer_type') == 'image' ? 'checked' : '' }}> Image
                                    @error('answer_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3" id="textAnswerInput"
                                    style="{{ old('answer_type') == 'text' ? '' : 'display:none;' }}">
                                    <label for=""><strong>Answer (Text)</strong></label>
                                    <input type="text" name="choice" class="form-control"
                                        value="{{ old('choice') }}">
                                    @error('choice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3" id="imageAnswerInput"
                                    style="{{ old('answer_type') == 'image' ? '' : 'display:none;' }}">
                                    <label for=""><strong>Answer (Image)</strong></label>
                                    <input type="file" name="choice_image" class="form-control" id="fileInput2">
                                    @error('choice_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Is Correct</strong></label>
                                    <input type="checkbox" name="is_correct" {{ old('is_correct') ? 'checked' : '' }}>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ old('choice_image') ? asset('images/' . old('choice_image')) : asset('img/no_image.jpg') }}"
                                        class="img-fluid mt-3" id="filePreview2">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @foreach ($question->choices as $choice)
        <div class="modal fade" id="editModal{{ $choice->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Answer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Jika menggunakan method PUT untuk update -->

                                    <div class="form-group mb-3">
                                        <label for=""><strong>Label</strong></label>
                                        <input type="text" name="label" class="form-control"
                                            value="{{ old('label', $choice->label) }}">
                                        @error('label')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for=""><strong>Answer Type</strong></label><br>
                                        <input type="radio" name="answer_type" value="text"
                                            id="editAnswerTypeText{{ $choice->id }}"
                                            {{ old('answer_type', $choice->answer_type) == 'text' ? 'checked' : '' }}> Text
                                        <input type="radio" name="answer_type" value="image"
                                            id="editAnswerTypeImage{{ $choice->id }}"
                                            {{ old('answer_type', $choice->answer_type) == 'image' ? 'checked' : '' }}>
                                        Image
                                        @error('answer_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3" id="editTextAnswerInput{{ $choice->id }}"
                                        style="{{ old('answer_type', $choice->answer_type) == 'text' ? '' : 'display:none;' }}">
                                        <label for=""><strong>Answer (Text)</strong></label>
                                        <input type="text" name="choice" class="form-control"
                                            value="{{ old('choice', $choice->choice) }}">
                                        @error('choice')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3" id="editImageAnswerInput{{ $choice->id }}"
                                        style="{{ old('answer_type', $choice->answer_type) == 'image' ? '' : 'display:none;' }}">
                                        <label for=""><strong>Answer (Image)</strong></label>
                                        <input type="file" name="choice_image" class="form-control"
                                            id="editFileInput2{{ $choice->id }}">
                                        <img src="{{ old('choice_image', $choice->choice_image ? asset('images/' . $choice->choice_image) : asset('img/no_image.jpg')) }}"
                                            class="img-fluid mt-3" id="editFilePreview2{{ $choice->id }}">
                                        @error('choice_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for=""><strong>Is Correct</strong></label>
                                        <input type="checkbox" name="is_correct"
                                            {{ old('is_correct', $choice->is_correct) ? 'checked' : '' }}>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ old('choice_image', $choice->choice_image ? asset('images/' . $choice->choice_image) : asset('img/no_image.jpg')) }}"
                                            class="img-fluid mt-3" id="editFilePreview2{{ $choice->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection

@push('js')
    <script>
        document.getElementById('fileInput2').onchange = function(event) {
            var reader = new FileReader();

            reader.onload = function() {
                var output = document.getElementById('filePreview2');
                output.src = reader.result;
            };

            reader.readAsDataURL(event.target.files[0]);
        };

        document.addEventListener("DOMContentLoaded", function() {
            var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            @if ($errors->any())
                exampleModal.show();
            @endif

            // Toggle input fields based on answer type selection
            document.querySelectorAll('input[name="answer_type"]').forEach(function(el) {
                el.addEventListener('change', function() {
                    if (this.value === 'text') {
                        document.getElementById('textAnswerInput').style.display = '';
                        document.getElementById('imageAnswerInput').style.display = 'none';
                    } else if (this.value === 'image') {
                        document.getElementById('textAnswerInput').style.display = 'none';
                        document.getElementById('imageAnswerInput').style.display = '';
                    }
                });
            });

            // Initialize based on old input
            if (document.querySelector('input[name="answer_type"]:checked').value === 'image') {
                document.getElementById('textAnswerInput').style.display = 'none';
                document.getElementById('imageAnswerInput').style.display = '';
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @foreach ($question->choices as $choice)
                document.getElementById('editFileInput2{{ $choice->id }}').onchange = function(event) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        var output = document.getElementById('editFilePreview2{{ $choice->id }}');
                        output.src = reader.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                };

                document.getElementById('editAnswerTypeText{{ $choice->id }}').addEventListener('change',
                    function() {
                        document.getElementById('editTextAnswerInput{{ $choice->id }}').style.display = '';
                        document.getElementById('editImageAnswerInput{{ $choice->id }}').style.display =
                            'none';
                    });

                document.getElementById('editAnswerTypeImage{{ $choice->id }}').addEventListener('change',
                    function() {
                        document.getElementById('editTextAnswerInput{{ $choice->id }}').style.display =
                            'none';
                        document.getElementById('editImageAnswerInput{{ $choice->id }}').style.display = '';
                    });

                if (document.querySelector('input[name="answer_type"]:checked') && document.querySelector(
                        'input[name="answer_type"]:checked').value === 'image') {
                    document.getElementById('editTextAnswerInput{{ $choice->id }}').style.display = 'none';
                    document.getElementById('editImageAnswerInput{{ $choice->id }}').style.display = '';
                } else {
                    document.getElementById('editTextAnswerInput{{ $choice->id }}').style.display = '';
                    document.getElementById('editImageAnswerInput{{ $choice->id }}').style.display = 'none';
                }
            @endforeach
        });
    </script>
@endpush
