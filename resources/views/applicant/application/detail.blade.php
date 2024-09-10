@extends('partials.applicant.navbar')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <dl class="row mt-3">
                    <dt class="col-sm-3" style="font-size: 1rem">Nomor Lamaran</dt>
                    <dd class="col-sm-9" style="font-size: 1rem">{{ $apl->reg_no }}</dd>

                    <dt class="col-sm-3" style="font-size: 1rem">Tanggal Melamar</dt>
                    <dd class="col-sm-9" style="font-size: 1rem">@formatDate($apl->reg_date)</dd>

                    <dt class="col-sm-3" style="font-size: 1rem">Status</dt>
                    <dd class="col-sm-9" style="font-size: 1rem"><label class="badge badge-danger" for="Closed"
                            style="Closed">{{ $apl->status }}</label></dd>
                </dl>
                <hr>
                <div class="row pl-3 pr-3 d-flex justify-content-between">
                    <div class="float-left">
                        <h3 class="title-main mb-4">Psikotes Online</h3>
                    </div>
                </div>
                <div class="mb-3">
                    Untuk dapat melanjutkan proses lamaran kerja ini, silahkan mengerjakan test assessment yang ber-status
                    OPEN atau INPROGRESS dibawah ini sampai dengan
                    Job Application <label class="badge badge-success">
                        {{ $apl->reg_no }}
                    </label> berstatus <label class="badge badge-info text-center">COMPLETED</label>
                    <br>
                    Hanya ada 1 test yang aktif dalam 1 waktu. Setelah anda menyelesaikan test yang aktif (status berubah
                    menjadi COMPLETED), anda bisa mengerjakan test selanjutnya.
                    <br>
                    Jika anda baru saja menyelesaikan test &amp; statusnya belum berubah, silahkan click "Refresh Test List"
                    <br>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover dataTable no-footer" style="width: 100%;"
                        id="assTest-list-table" role="grid" aria-describedby="assTest-list-table_info">
                        <thead>
                            <tr>
                                <th>Nomor Tes</th>
                                <th>Nama Tes</th>
                                <th>Status</th>
                                <th>Nomor Lamaran</th>
                                <th>Tanggal Pengerjaan Tes</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <tr role="row" class="odd">
                                <td class="sorting_1"><strong>{{ $apl->test->test_no }}</strong></td>
                                <td><strong>{{ $apl->test->name }}</strong></td>
                                <td>
                                    <form method="POST">
                                    @csrf
                                    @if ($apl->test->status == 'DRAFT')
                                    <input type="submit" formaction="{{ route('applicant.application.test.open', $apl->test->id) }}" value="OPEN" class="fw-bold btn mt-3 bg-info"/>
                                    </form>
                                    @elseif ($apl->test->status == 'OPEN')
                                    <a type="submit" href="{{ route('applicant.application.test.index', $apl->test->id) }}" class="fw-bold btn mt-3 bg-warning">INCLOMPLETE</a>
                                    @else
                                    <span class="badge bg-success text-dark"><strong>{{ $apl->test->status }}</strong></span>
                                    @endif
                                </td>
                                <td><span class="badge bg-info text-dark"><strong>{{ $apl->reg_no }}</strong></span></td>
                                <td style="font-weight: bold">
                                    @if(is_null($apl->test->start_time))
                                        BELUM DIMULAI
                                    @else
                                        {{ \Carbon\Carbon::parse($apl->test->start_time)->format('d/m/Y H:i:s') }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($apl->test->status == 'COMPLETED')
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <strong>Terima Kasih telah mengikuti test assessment ini. Selanjutnya kami akan review lamaran kamu, dan akan mengupdate status nya </strong>.
                    </div>
                    @endif
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
