@extends('applicant.profile.index')
@section('tab')
    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Tambah Pendidikan
    </button>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Pendidikan</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Jenjang</th>
                            <th>Jurusan</th>
                            <th>Institusi</th>
                            <th>Tahun Masuk</th>
                            <th>Tahuk Keluar</th>
                            <th>Nilai Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::guard('user')->user()->education_details)
                            @forelse (Auth::guard('user')->user()->education_details as $education_detail)
                                <tr>
                                    <td>{{ $education_detail->degree }}</td>
                                    <td>{{ $education_detail->major }}</td>
                                    <td>{{ $education_detail->university }}</td>
                                    <td>{{ $education_detail->entry_year }}</td>
                                    <td>{{ $education_detail->end_year }}</td>
                                    <td>{{ $education_detail->grade }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $education_detail->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $education_detail->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="text-align:center" colspan="6"><strong>Tidak ada data</strong></td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('applicant.profile.education.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Jenjang</label>
                                    <select name="degree" class="onlybottom">
                                        <option value="SMA/SMK">SMA/SMK</option>
                                        <option value="D3" {{ old('degree') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="D4" {{ old('degree') == 'D4' ? 'selected' : '' }}>D4</option>
                                        <option value="S1" {{ old('degree') == 'S1' ? 'selected' : '' }}>S1</option>
                                        <option value="S2" {{ old('degree') == 'S2' ? 'selected' : '' }}>S2</option>
                                        <option value="S3" {{ old('degree') == 'S3' ? 'selected' : '' }}>S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Jurusan</label>
                                    <input type="text" name="major" class="onlybottom"
                                        placeholder="Masukkan nama jurusan" value="{{ old('major') }}">
                                    @error('major')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label for="" class="register-label">Sekolah/Universitas</label>
                            <input type="text" placeholder="Masukkan nama sekolah/universitas" name="university"
                                class="onlybottom" value="{{ old('university') }}">
                            @error('university')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Tahun Masuk</label>
                                    <input type="text" name="entry_year" class="onlybottom"
                                        value="{{ old('entry_year') }}" placeholder="Masukkan tahun masuk, contoh: 2015">
                                    @error('entry_year')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Tahun Lulus</label>
                                    <input type="text" name="end_year" class="onlybottom" value="{{ old('end_year') }}"
                                        placeholder="Masukkan tahun lulus, contoh: 2017">
                                    @error('end_year')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Nilai Akhir</label>
                                    <input type="text" name="grade" class="onlybottom" value="{{ old('grade') }}"
                                        placeholder="Contoh 87.5">
                                    @error('grade')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Edit Data Pendidikan -->
    @if (Auth::guard('user')->user()->education_details)
        @foreach (Auth::guard('user')->user()->education_details as $education_detail)
            <div class="modal fade" id="editModal{{ $education_detail->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('applicant.profile.education.update', $education_detail->id) }}"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Jenjang</label>
                                            <select name="degree" class="onlybottom">
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3"
                                                    {{ $education_detail->degree == 'D3' ? 'selected' : '' }}>D3</option>
                                                <option value="D4"
                                                    {{ $education_detail->degree == 'D4' ? 'selected' : '' }}>D4</option>
                                                <option value="S1"
                                                    {{ $education_detail->degree == 'S1' ? 'selected' : '' }}>S1</option>
                                                <option value="S2"
                                                    {{ $education_detail->degree == 'S2' ? 'selected' : '' }}>S2</option>
                                                <option value="S3"
                                                    {{ $education_detail->degree == 'S3' ? 'selected' : '' }}>S3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Jurusan</label>
                                            <input type="text" name="major" class="onlybottom"
                                                placeholder="Masukkan nama jurusan"
                                                value="{{ $education_detail->major }}">
                                            @error('major')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Sekolah/Universitas</label>
                                    <input type="text" placeholder="Masukkan nama sekolah/universitas"
                                        name="university" class="onlybottom"
                                        value="{{ $education_detail->university }}">
                                    @error('university')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Tahun Masuk</label>
                                            <input type="text" name="entry_year" class="onlybottom"
                                                value="{{ $education_detail->entry_year }}"
                                                placeholder="Masukkan tahun masuk, contoh: 2015">
                                            @error('entry_year')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Tahun Lulus</label>
                                            <input type="text" name="end_year" class="onlybottom"
                                                value="{{ $education_detail->end_year }}"
                                                placeholder="Masukkan tahun lulus, contoh: 2017">
                                            @error('end_year')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Nilai Akhir</label>
                                            <input type="text" name="grade" class="onlybottom"
                                                value="{{ $education_detail->grade }}" placeholder="Contoh 87.5">
                                            @error('grade')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary text-white">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                @if (session()->has('edit_id'))
                    var editModalId = {{ session('edit_id') }};
                    var editModal = new bootstrap.Modal(document.getElementById('editModal' + editModalId), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    editModal.show();
                @else
                    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    myModal.show();
                @endif
            @endif
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const dataId = this.getAttribute('data-id');
                    const deleteUrl = `{{ route('applicant.profile.education.delete', ':id') }}`
                        .replace(':id', dataId);

                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu tidak dapat memulihkan data ini kembali!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Aksi penghapusan dengan redirect ke route Laravel
                            window.location.href = deleteUrl;
                        }
                    });
                });
            });
        });
    </script>
@endpush
