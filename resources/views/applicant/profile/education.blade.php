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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                      <div class="row">
                        <div class="col-sm-2">
                          <div class="form-group mb-3">
                            <label for="" class="register-label">Jenjang</label>
                            <select name="degree" class="onlybottom">
                              <option value="SMA/SMK">SMA/SMK</option>
                              <option value="D3">D3</option>
                              <option value="D4">D4</option>
                              <option value="S1">S1</option>
                              <option value="S2">S2</option>
                              <option value="S3">S3</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-10">
                          <div class="form-group mb-3">
                            <label for="" class="register-label">Jurusan</label>
                            <input type="text" class="onlybottom" placeholder="Masukkan nama jurusan" value="{{ old('major') }}">
                          </div>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <label for="" class="register-label">Sekolah/Universitas</label>
                        <input type="text" placeholder="Masukkan nama sekolah/universitas" class="onlybottom" value="{{ old('major') }}">
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label for="" class="register-label">Tahun Masuk</label>
                            <input type="text" class="onlybottom" value="" placeholder="Masukkan tahun masuk, contoh: 2015">
                          </div>
                        </div>
                        
                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label for="" class="register-label">Tahun Lulus</label>
                            <input type="text" class="onlybottom" value="" placeholder="Masukkan tahun lulus, contoh: 2017">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group mb-3">
                            <label for="" class="register-label">Nilai Akhir</label>
                            <input type="text" class="onlybottom" value="" placeholder="Contoh 87.5">
                          </div>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
@endsection
