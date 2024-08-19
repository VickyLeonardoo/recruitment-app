@extends('partials.applicant.navbar')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-body">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
                    <li class="nav-item">
                        <button class="nav-link " data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#informasi-pribadi">Informasi Pribadi</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab"
                            data-bs-target="#profile-settings">Settings</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab"
                            data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">
                    <div class="tab-pane fade  profile-overview" id="profile-overview">
                        <h5 class="card-title">About</h5>
                        <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                            cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure
                            rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at
                            unde.</p>

                        <h5 class="card-title">Profile Details</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8">Kevin Anderson</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Company</div>
                            <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Job</div>
                            <div class="col-lg-9 col-md-8">Web Designer</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Country</div>
                            <div class="col-lg-9 col-md-8">USA</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Address</div>
                            <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Phone</div>
                            <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8">k.anderson@example.com</div>
                        </div>

                    </div>

                    <div class="tab-pane fade show active profile-edit pt-3" id="informasi-pribadi">

                        <!-- Profile Edit Form -->
                        <form method="POST" action="{{ route('applicant.profile.info') }}">
                            @csrf

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="onlybottom" placeholder="" 
                                               value="{{ Auth::guard('user')->user()->user_detail->full_name ?? '' }}" 
                                               name="full_name">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">No. NIK</label>
                                        <input type="text" class="onlybottom" placeholder="" value="{{ Auth::guard('user')->user()->user_detail->identity_no ?? '' }}" name="identity_no">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" class="onlybottom" placeholder="" value="{{ Auth::guard('user')->user()->user_detail->dob ?? '' }}" name="dob">
                                    </div>

                                    @if (!Auth::guard('user')->user()->user_detail)
                                    <div class="form-group mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select class="onlybottom" aria-label="Default select example" name="gender">
                                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                            <option value="male">Laki - Laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                    @else
                                    <div class="form-group mb-3">
                                        <label for="">Jenis Kelamin</label>
                                        <select class="onlybottom" aria-label="Default select example" name="gender">
                                            <option value="male" {{ Auth::guard('user')->user()->user_detail->gender == 'male' ? 'selected' : '' }}>Laki - Laki</option>
                                            <option value="female" {{ Auth::guard('user')->user()->user_detail->gender == 'female' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    @endif
                                    <div class="form-group mb-3">
                                        <label for="">Kota</label>
                                        <input type="text" class="onlybottom" placeholder="Masukkan kota domisili anda" value="{{ Auth::guard('user')->user()->user_detail->city ?? '' }}" name="city">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="text" class="removall" placeholder="" value="{{ Auth::guard('user')->user()->email }}" name="email" readonly>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">Nomor Ponsel</label>
                                        <input type="text" class="onlybottom" placeholder="" value="" name="phone">
                                    </div>
                                    @if (!Auth::guard('user')->user()->user_detail)
                                        <div class="form-group mb-3">
                                            <label for="">Agama</label>
                                            <select class="onlybottom" aria-label="Default select example" name="religion">
                                                <option value="islam">Islam</option>
                                                <option value="kristen">Kristen</option>
                                                <option value="hindu">Hindu</option>
                                                <option value="budha">Budha</option>
                                                <option value="konghuchu">Konghuchu</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="">Status</label>
                                            <select class="onlybottom" aria-label="Default select example" name="marital_status">
                                                <option value="" disabled selected>-- Pilih Status --</option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Janda">Janda</option>
                                                <option value="Duda">Duda</option>
                                                <option value="Cerai">Cerai</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                                <option value="Bercerai">Bercerai</option>
                                                <option value="Bercerai Mati">Bercerai Mati</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Kewarganegaraan</label>
                                            <select name="nationality" class="onlybottom">
                                                <option value="Singapore">Indonesia</option>
                                                <option value="Indonesia">Singapore</option>
                                            </select>
                                        </div>
                                    @else
                                        <div class="form-group mb-3">
                                            <label for="">Agama</label>
                                            <select class="onlybottom" aria-label="Default select example" name="religion">
                                                <option value="Islam" {{ Auth::guard('user')->user()->user_detail->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="kristen" {{ Auth::guard('user')->user()->user_detail->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="hindu" {{ Auth::guard('user')->user()->user_detail->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="budha" {{ Auth::guard('user')->user()->user_detail->religion == 'Budha' ? 'selected' : '' }}>Budha</option>
                                                <option value="konghuchu" {{ Auth::guard('user')->user()->user_detail->religion == 'Konghuchu' ? 'selected' : '' }}>Konghuchu</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="">Status</label>
                                            <select class="onlybottom" aria-label="Default select example" name="marital_status">
                                                <option value="" disabled selected>-- Pilih Status --</option>
                                                <option value="Menikah" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                                <option value="Belum Menikah" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                                <option value="Janda" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Janda' ? 'selected' : '' }}>Janda</option>
                                                <option value="Duda" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Duda' ? 'selected' : '' }}>Duda</option>
                                                <option value="Cerai" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                                                <option value="Cerai Mati" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                                <option value="Bercerai" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Bercerai' ? 'selected' : '' }}>Bercerai</option>
                                                <option value="Bercerai Mati" {{ Auth::guard('user')->user()->user_detail->marital_status == 'Bercerai Mati' ? 'selected' : '' }}>Bercerai Mati</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="">Kewarganegaraan</label>
                                            <select name="nationality" class="onlybottom">
                                                <option value="Singapore" {{ Auth::guard('user')->user()->user_detail->nationality == 'Singapore' ? 'selected' : '' }}>Indonesia</option>
                                                <option value="Indonesia" {{ Auth::guard('user')->user()->user_detail->nationality == 'Indonesia' ? 'selected' : '' }}>Singapore</option>
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Alamat</label>
                                    <textarea name="address" style="height: 60px" class="onlybottom">{{ Auth::guard('user')->user()->user_detail->address ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Simpan" class="btn btn-secondary">
                                </div>
                            </div>
                        </form><!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">

                        <!-- Settings Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                    Notifications</label>
                                <div class="col-md-8 col-lg-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="changesMade"
                                            checked>
                                        <label class="form-check-label" for="changesMade">
                                            Changes made to your account
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newProducts"
                                            checked>
                                        <label class="form-check-label" for="newProducts">
                                            Information on new products and services
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="proOffers">
                                        <label class="form-check-label" for="proOffers">
                                            Marketing and promo offers
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="securityNotify"
                                            checked disabled>
                                        <label class="form-check-label" for="securityNotify">
                                            Security alerts
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form><!-- End settings Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control"
                                        id="currentPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                    Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="newpassword" type="password" class="form-control"
                                        id="newPassword">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                    New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="renewpassword" type="password" class="form-control"
                                        id="renewPassword">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>
    </div>
@endsection
