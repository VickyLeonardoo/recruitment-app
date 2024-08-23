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
                        @if (Auth::guard('user')->user()->language_details)
                            @forelse (Auth::guard('user')->user()->language_details as $lang)
                                <tr>
                                    <td>{{ $lang->language->name }}</td>
                                    <td>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $lang->id }}">
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
                <form action="{{ route('applicant.profile.language.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="" class="register-label">Bahasa</label>
                            <select name="language_id" class="onlybottom">
                                @foreach ($langs as $lang)
                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="register-label">Level Keahlian</label>
                            <select name="level" class="onlybottom">
                                <option value="Pasif">Pasif</option>
                                <option value="Aktif">Aktif</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const dataId = this.getAttribute('data-id');
                    const deleteUrl = `{{ route('applicant.profile.language.delete', ':id') }}`
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
