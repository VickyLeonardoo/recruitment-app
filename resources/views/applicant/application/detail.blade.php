@extends('partials.applicant.navbar')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body" >
                <dl class="row mt-3">
                    <dt class="col-sm-3" style="font-size: 1rem">Nomor Lamaran</dt>
                    <dd class="col-sm-9" style="font-size: 1rem">{{ $apl->reg_no }}</dd>
                
                    <dt class="col-sm-3" style="font-size: 1rem">Tanggal Melamar</dt>
                    <dd class="col-sm-9" style="font-size: 1rem">@formatDate($apl->reg_date)</dd>
                
                    <dt class="col-sm-3" style="font-size: 1rem">Status</dt>
                    <dd class="col-sm-9" style="font-size: 1rem"><label class="badge badge-danger" for="Closed" style="Closed">{{ $apl->status }}</label></dd>
                </dl>
                <hr>
                <div class="row pl-3 pr-3 d-flex justify-content-between">
                    <div class="float-left">
                        <h3 class="title-main mb-4">Psikotes Online</h3>
                    </div>
                </div>
                <div class="mb-3">
                    Untuk dapat melanjutkan proses lamaran kerja ini, silahkan mengerjakan test assessment yang ber-status OPEN atau INPROGRESS dibawah ini sampai dengan
                    Job Application <label class="badge badge-success">
                        {{ $apl->reg_no }}
                    </label> berstatus <label class="badge badge-info text-center">COMPLETED</label>
                    <br>
                    Hanya ada 1 test yang aktif dalam 1 waktu. Setelah anda menyelesaikan test yang aktif (status berubah menjadi COMPLETED), anda bisa mengerjakan test selanjutnya.
                    <br>
                    Jika anda baru saja menyelesaikan test &amp; statusnya belum berubah, silahkan click "Refresh Test List"
                    <br>
                </div>
                <div class="table-respon">
                    <table class="table table-bordered table-hover dataTable no-footer" style="width: 100%;" id="assTest-list-table" role="grid" aria-describedby="assTest-list-table_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 9px;"></th>
                                <th class="sorting_asc" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nomor Tes: activate to sort column descending" style="width: 144px;">Nomor Tes</th>
                                <th class="sorting" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-label="Nama Tes: activate to sort column ascending" style="width: 141px;">Nama Tes</th>
                                <th class="sorting" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 123px;">Status</th>
                                <th class="sorting" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-label="Nomor Lamaran: activate to sort column ascending" style="width: 205px;">Nomor Lamaran</th>
                                <th class="sorting" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-label="Pekerjaan: activate to sort column ascending" style="width: 134px;">Pekerjaan</th>
                                <th class="sorting" tabindex="0" aria-controls="assTest-list-table" rowspan="1" colspan="1" aria-label="Tanggal Pengerjaan Tes: activate to sort column ascending" style="width: 293px;">Tanggal Pengerjaan Tes</th></tr>
                        </thead>
                        <tbody>
            
                            
                        <tr role="row" class="odd"><td></td><td class="sorting_1">1089045</td><td>Basic External</td><td><label class="badge badge-unread text-center">COMPLETED</label></td><td><label class="badge badge-hiring">APP20240407805</label></td><td>Administrasi</td><td>18/04/2024 12:09:57</td></tr></tbody>
                    </table>

                </div>
                <hr>
                <h3>Interview</h3>
                <div class="table-resposive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Schedule</th>
                                <th>Interview Place</th>
                                <th>Realized On</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection