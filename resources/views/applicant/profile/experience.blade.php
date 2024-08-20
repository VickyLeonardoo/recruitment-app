@extends('applicant.profile.index')
@section('tab')
    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Tambah Pengalaman
    </button>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Pengalaman</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Tahun Masuk</th>
                            <th>Tahun Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::guard('user')->user()->experience_details)
                            @forelse (Auth::guard('user')->user()->experience_details as $exp)
                                <tr>
                                    <td>{{ $exp->company_name }}</td>
                                    <td>{{ $exp->designation }}</td>
                                    <td>{{ $exp->entry_date }}</td>
                                    <td>{{ $exp->end_date }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $exp->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $exp->id }}">
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengalaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('applicant.profile.experience.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="register-label">Nama Perusahaan</label>
                            <input type="text" placeholder="Masukkan nama perusahaan tempat anda bekerja sebelumnya" name="company_name"
                                class="onlybottom" value="{{ old('university') }}">
                            @error('company_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="" class="register-label">Jabatan Pekerjaan</label>
                            <input type="text" placeholder="Masukkan jabatan anda di perusahaan tempat anda bekerja sebelumnya" name="designation"
                                class="onlybottom" value="{{ old('designation') }}">
                            @error('designation')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Tahun Masuk</label>
                                    <input type="text" name="entry_date" class="onlybottom"
                                        value="{{ old('entry_date') }}" id="datepicker" placeholder="Masukkan tahun masuk">
                                    @error('entry_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Tahun Lulus</label>
                                    <input type="text" name="end_date" id="datepicker1" class="onlybottom" value="{{ old('end_date') }}"
                                        placeholder="Masukkan tahun selesai">
                                    @error('end_date')
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
    @if (Auth::guard('user')->user()->experience_details)
        @foreach (Auth::guard('user')->user()->experience_details as $exp)
            <div class="modal fade" id="editModal{{ $exp->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('applicant.profile.experience.update', $exp->id) }}"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Nama Perusahaan</label>
                                    <input type="text" placeholder="Masukkan nama perusahaan tempat anda bekerja sebelumnya" name="company_name"
                                        class="onlybottom" value="{{ $exp->company_name }}">
                                    @error('company_name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Jabatan Pekerjaan</label>
                                    <input type="text" placeholder="Masukkan jabatan anda di perusahaan tempat anda bekerja sebelumnya" name="designation"
                                        class="onlybottom" value="{{ $exp->designation }}">
                                    @error('designation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Tahun Masuk</label>
                                            <input type="text" name="entry_date" class="onlybottom"
                                                value="{{ $exp->entry_date }}" id="datepicker" placeholder="Masukkan tahun masuk">
                                            @error('entry_date')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-sm-6">
                                        <div class="form-group mb-3">
                                            <label for="" class="register-label">Tahun Lulus</label>
                                            <input type="text" name="end_date" id="datepicker1" class="onlybottom" value="{{ $exp->end_date }}"
                                                placeholder="Masukkan tahun selesai">
                                            @error('end_date')
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
                    const deleteUrl = `{{ route('applicant.profile.experience.delete', ':id') }}`
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
