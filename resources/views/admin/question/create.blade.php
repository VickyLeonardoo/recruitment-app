@extends('partials.admin.header')
@section('content')
    <div class="row">
        {{-- <div class="mb-3 text-end">
            <a href="{{ route('admin.departement') }}" class="btn btn-primary"> <i class="fas fa-arrow-left"></i> Back</a>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> The ' * ' field is required
                </div>
                <form action="{{ route('admin.question.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for=""><strong>Type</strong></label>
                                <select name="type" class="form-control-lg form-control {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="multiple_choice">Multiple Choice</option>
                                    <option value="essay">Essay</option>
                                    <option value="true_false">True/False</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for=""><strong>Description*</strong></label>
                                <textarea name="description" rows="3" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for=""><strong>Image</strong></label>
                                <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" id="fileInput" accept="image/png, image/gif, image/jpeg">
                            </div>
                            <div class="form-group mb-3">
                                <label for=""><strong>Difficult</strong></label>
                                <select name="difficult" class="form-control-lg form-control {{ $errors->has('difficult') ? 'is-invalid' : '' }}">
                                    <option value="" selected disabled>Select Difficult</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" class="btn btn-primary form-control" value="Save">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Preview Image</h4>
                                    <hr>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('img/no_image.jpg') }}" class="img-fluid" id="filePreview">
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