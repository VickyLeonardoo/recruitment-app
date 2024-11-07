<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Reset Password | Recruitment App</title>

    <link href="{{ asset('template') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('custom') }}/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-xl-6 col-md-6 col-lg-6 col-xl-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (!$user)
                            <div class="alert alert-danger" role="alert">
                                Token tidak valid atau telah kadaluarsa!.
                            </div>
                            <div class="d-grid gap-2 col-3 mx-auto">
                                <a href="{{ route('auth.login') }}" class="btn btn-primary" type="submit">Confirm</a>
                            </div>
                        @else
                            <form method="POST" action="{{ route('auth.process.reset.password', $user->token) }}">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h1
                                                style="font-weight: 1000; font-size: 2rem; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                                                Reset Password</h1>
                                            {{-- <p>Buat akun untuk melamar dan memantau status aplikasi Anda dengan mudah. --}}
                                            </p>
                                        </div>
                                        <div class="row">

                                            <div class="mb-3">
                                                <label class="register-label">Your Email<span style="color:red">
                                                        *</span></label>
                                                @if (!$user->user_id)
                                                    <input class="form-register" type="email" name="name" disabled
                                                        value="{{ $user->staff->email }}" />
                                                @else
                                                    <input class="form-register" type="email" name="name" disabled
                                                        value="{{ $user->user->email }}" />
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label class="register-label">Your Name<span style="color:red">
                                                        *</span></label>
                                                @if (!$user->user_id)
                                                    <input class="form-register" type="text" name="name" disabled
                                                        value="{{ $user->staff->name }}" />
                                                @else
                                                    <input class="form-register" type="text" name="name" disabled
                                                        value="{{ $user->user->user_detail->full_name }}" />
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label class="register-label" style="">Kata Sandi<span
                                                        style="color:red"> *</span></label>
                                                <input class="form-register" type="password" name="password"
                                                    autocomplete="off" placeholder="Masukkan kata sandi" />
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="register-label" style="">Konfirmasi Kata Sandi<span
                                                        style="color:red"> *</span></label>
                                                <input class="form-register" type="password"
                                                    name="password_confirmation" autocomplete="off"
                                                    placeholder="Ketik ulang kata sandi" />
                                                @error('password_confirmation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="alert alert-danger" role="alert">
                                Pastikan seluruh data yang diisi sudah benar karena data yang sudah diinput tidak dapat
                                diubah!.
                            </div> --}}
                                <div class="d-grid gap-2 col-3 mx-auto">
                                    <button class="btn btn-primary" type="submit">Confirm</button>
                                </div>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="js/app.js"></script>
    <script>
        $(function() {
            $("#datepickerYear").datepicker();
        });
    </script>
    </head>
</body>

</html>
