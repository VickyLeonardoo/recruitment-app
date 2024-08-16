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
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> The ' * ' field is required
                </div>
                <form action="{{ route('admin.question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for=""><strong>Type</strong></label>
                                <select name="type"
                                    class="form-control-lg form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                    <option value="multiple_choice"
                                        {{ $question->type == 'Multiple Choicee' ? 'selected' : '' }}>Multiple Choice
                                    </option>
                                    <option value="true_false" {{ $question->type == 'True/False' ? 'selected' : '' }}>
                                        True/False</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for=""><strong>Description*</strong></label>
                                <textarea name="description" rows="3" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $question->description }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            @if ($question->image)
                                <div class="form-group mb-3">
                                    <label for=""><strong>Image</strong></label>
                                    <input type="file" name="image"
                                        class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="fileInput"
                                        accept="image/png, image/gif, image/jpeg">
                                </div>
                            @endif

                            <div class="form-group mb-3">
                                <label for=""><strong>Difficult</strong></label>
                                <select name="difficult"
                                    class="form-control-lg form-control {{ $errors->has('difficult') ? 'is-invalid' : '' }}">
                                    <option value="easy" {{ $question->difficult == 'Easy' ? 'selected' : '' }}>Easy
                                    </option>
                                    <option value="medium" {{ $question->difficult == 'Medium' ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="hard" {{ $question->difficult == 'Hard' ? 'selected' : '' }}>Hard
                                    </option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary form-control" value="Save">
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Answer</h4>
                                </div>
                                <div class="card-body">
                                    @if ($question->type == 'Multiple Choice')
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Label</th>
                                                    <th>Answer</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($question->choices as $choice)
                                                    <tr>
                                                        <td>{{ $choice->label }}</td>
                                                        <td>{{ $choice->choice }}</td>
                                                        <td>{{ $choice->is_corect }}</td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="4">No Answer Found</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    @endif
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
                </form>

            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    document.getElementById('fileInput').onchange = function(event) {
        var reader = new FileReader();

        reader.onload = function(){
            var output = document.getElementById('filePreview');
            output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    };
</script>
@endpush