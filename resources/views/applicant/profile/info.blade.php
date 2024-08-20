@extends('applicant.profile.index')
@section('tab')
<form method="POST" action="{{ route('applicant.profile.info.update') }}">
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
                <input type="text" class="onlybottom" placeholder="" value="{{ Auth::guard('user')->user()->user_detail->phone ?? '' }}" name="phone">
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
                    <select class="onlybottom" aria-label="Default select example" name="status">
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
                        <option value="Kristen" {{ Auth::guard('user')->user()->user_detail->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Hindu" {{ Auth::guard('user')->user()->user_detail->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ Auth::guard('user')->user()->user_detail->religion == 'Budha' ? 'selected' : '' }}>Budha</option>
                        <option value="Konghuchu" {{ Auth::guard('user')->user()->user_detail->religion == 'Konghuchu' ? 'selected' : '' }}>Konghuchu</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="">Status</label>
                    <select class="onlybottom" aria-label="Default select example" name="status">
                        <option value="" disabled selected>-- Pilih Status --</option>
                        <option value="Menikah" {{ Auth::guard('user')->user()->user_detail->status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Belum Menikah" {{ Auth::guard('user')->user()->user_detail->status == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Janda" {{ Auth::guard('user')->user()->user_detail->status == 'Janda' ? 'selected' : '' }}>Janda</option>
                        <option value="Duda" {{ Auth::guard('user')->user()->user_detail->status == 'Duda' ? 'selected' : '' }}>Duda</option>
                        <option value="Cerai" {{ Auth::guard('user')->user()->user_detail->status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                        <option value="Cerai Mati" {{ Auth::guard('user')->user()->user_detail->status == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                        <option value="Bercerai" {{ Auth::guard('user')->user()->user_detail->status == 'Bercerai' ? 'selected' : '' }}>Bercerai</option>
                        <option value="Bercerai Mati" {{ Auth::guard('user')->user()->user_detail->status == 'Bercerai Mati' ? 'selected' : '' }}>Bercerai Mati</option>
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
@endsection
