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
                                                <td>
                                                    @if ($choice->choice)
                                                        {{ $choice->choice }}
                                                    @elseif ($choice->choiceImage)
                                                        <img src="{{ asset('storage/answer/' . $choice->choiceImage) }}"
                                                            class="img-fluid" />
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($choice->is_correct)
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
                                    <img src="{{ asset('storage/question/' . $question->image) }}" class="img-fluid"
                                        id="filePreview">
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
                                    <input type="text" name="label" class="form-control" value="{{ old('label') }}">
                                    @error('label')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Answer Type</strong></label>
                                    <select id="answerType" class="form-control" name="answer_type">
                                        <option value="text" selected>Text</option>
                                        <option value="image">Image</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3" id="textInput">
                                    <label for=""><strong>Answer</strong></label>
                                    <input type="text" name="choice" class="form-control"
                                        value="{{ old('choice') }}" placeholder="Answer">
                                </div>

                                <div class="form-group mb-3" id="imageInput" style="display: none;">
                                    <label for=""><strong>Upload Image</strong></label>
                                    <input type="file" class="form-control mt-3" id="fileInput"
                                        accept="image/png, image/gif, image/jpeg" name="choice_image"
                                        value="{{ old('choice_image') }}">
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
                                <div class="form-group mb-3">
                                    <label for=""><strong>Label</strong></label>
                                    <input type="text" name="label" class="form-control"
                                        value="{{ old('label', $choice->label) }}">
                                    @error('label')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for=""><strong>Answer Type</strong></label>
                                    <select id="answerTypeEdit{{ $choice->id }}" class="form-control" name="answer_type">
                                        <option value="text" {{ $choice->choice ? 'selected' : '' }}>Text</option>
                                        <option value="image" {{ $choice->choiceImage ? 'selected' : '' }}>Image</option>
                                    </select>
                                </div>

                                <!-- Conditionally render the Text input -->
                                <div class="form-group mb-3" id="textInputEdit{{ $choice->id }}"
                                    style="{{ $choice->choice ? '' : 'display: none;' }}">
                                    <label for=""><strong>Answer</strong></label>
                                    <input type="text" name="choice" class="form-control"
                                        value="{{ old('choice', $choice->choice) }}">
                                </div>

                                <!-- Conditionally render the Image input -->
                                <div class="form-group mb-3" id="imageInputEdit{{ $choice->id }}"
                                    style="{{ $choice->choiceImage ? '' : 'display: none;' }}">
                                    <label for=""><strong>Upload Image</strong></label>
                                    <input type="file" class="form-control" id="fileInput3"
                                        accept="image/png, image/gif, image/jpeg" name="choice_image">
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
                                <div class="card-header text-center">
                                    Current Image
                                </div>
                                <div class="card-body text-center">
                                    @if ($choice->choiceImage)
                                        <img src="{{ asset('storage/answer/' . $choice->choiceImage) }}"
                                            class="img-fluid" id="filePreview3">
                                    @else
                                        <img src="{{ asset('img/no_image.jpg') }}" class="img-fluid"
                                            id="filePreview3">
                                    @endif
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
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener untuk perubahan pada jenis jawaban
            document.getElementById('answerType').addEventListener('change', function() {
                var value = this.value;
                console.log('Selected Answer Type:', value); // Debugging line
                document.getElementById('textInput').style.display = value === 'text' ? 'block' : 'none';
                document.getElementById('imageInput').style.display = value === 'image' ? 'block' : 'none';
            });

            // Perbarui tampilan saat modal ditampilkan
            var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            document.getElementById('exampleModal').addEventListener('show.bs.modal', function() {
                var answerType = document.getElementById('answerType').value;
                console.log('Modal Open - Answer Type:', answerType); // Debugging line
                document.getElementById('textInput').style.display = answerType === 'text' ? 'block' :
                    'none';
                document.getElementById('imageInput').style.display = answerType === 'image' ? 'block' :
                    'none';
            });

            // Update preview image when a file is selected
            document.getElementById('fileInput').addEventListener('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('filePreview2');
                    output.src = reader.result;
                };
                if (event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
            // Initialize modal state based on form data
            var initialAnswerType = document.getElementById('answerType').value;
            console.log('Initial Answer Type:', initialAnswerType); // Debugging line
            document.getElementById('textInput').style.display = initialAnswerType === 'text' ? 'block' : 'none';
            document.getElementById('imageInput').style.display = initialAnswerType === 'image' ? 'block' : 'none';
        });
    </script>

<script>
    $(document).ready(function() {
        // Handler for select change event
        $(document).on('change', 'select[id^="answerTypeEdit"]', function() {
            // Get the modal ID based on the select element
            const modalId = $(this).attr('id').replace('answerTypeEdit', '');
            const selectedValue = $(this).val();

            // Toggle visibility based on selected value
            if (selectedValue === 'text') {
                $('#textInputEdit' + modalId).show();
                $('#imageInputEdit' + modalId).hide();
            } else if (selectedValue === 'image') {
                $('#textInputEdit' + modalId).hide();
                $('#imageInputEdit' + modalId).show();
            }
        }).trigger('change'); // Trigger change event on page load to set initial visibility
    });
</script>
@endpush
