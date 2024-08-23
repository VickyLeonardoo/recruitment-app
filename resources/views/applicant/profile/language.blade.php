@extends('applicant.profile.index')
@section('tab')
    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Tambah Keahlian
    </button>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Keahlian</h4>
            <div class="table-responsive">
                <table class="table" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 70%">Nama</th>
                            <th style="width: 30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (Auth::guard('user')->user()->skill_details)
                            @forelse (Auth::guard('user')->user()->skill_details as $skill)
                                <tr>
                                    <td>{{ $skill->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $skill->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $skill->id }}">
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
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Keahlian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('applicant.profile.skills.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="register-label">Nama Keahlian</label>
                            <input type="text" placeholder="Masukkan keahlian kamu" autocomplete="off" name="name"
                                class="onlybottom" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
    @if (Auth::guard('user')->user()->skill_details)
        @foreach (Auth::guard('user')->user()->skill_details as $skill)
            <div class="modal fade" id="editModal{{ $skill->id }}" data-bs-backdrop="static"
                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('applicant.profile.skills.update', $skill->id) }}"
                            method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="" class="register-label">Nama Perusahaan</label>
                                    <input type="text" placeholder="Masukkan nama keahlian kamu" name="name"
                                        class="onlybottom" value="{{ $skill->name }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
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
    {{-- End Modal --}}

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
                    const deleteUrl = `{{ route('applicant.profile.skills.delete', ':id') }}`
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
