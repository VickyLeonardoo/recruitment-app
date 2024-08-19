<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('applicant') }}/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('applicant') }}/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="{{ asset('custom') }}/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <style>
        .alert-custom {
            position: relative;
            border: 1px solid transparent;
            text-align: center;
        }

        .alert-custom-danger {
            color: #F95F53;
            background-color: #F4F5F7;
            /* border-color: #fdcfcb; */
            border-bottom: solid black
        }
    </style>
</head>

<body class="labelnew">
    <div class="alert-custom alert-custom-danger" role="alert">
        <p style="color: black">
            <i class="mdi mdi-alert" style="color: red"></i> <strong>
                McDermott tidak memungut biaya apapun selama proses pendaftaran dan seleksi karir berlangsung.
            </strong>
        </p>
    </div>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
                                <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a href="{{ route('auth.logout') }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</a>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-8">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <ul class="navbar-nav">
                                @if (!Auth::guard('user')->user()->user_detail)
                                    <div class="alert alert-warning" style="color: black" role="alert">
                                        <strong>Peringatan!</strong> Kamu belum melengkapi profile kamu, mohon lengkapi
                                        profile agar dapat melakukan pendaftaran.
                                        <a href="{{ route('applicant.profile') }}" class="alert-link">Klik Disini</a>
                                    </div>
                                @endif
                                <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                                    <h4 class="welcome-text">Good Morning, <span
                                            class="text-black fw-bold">{{ Auth::guard('user')->user()->email }}</span>
                                    </h4>
                                </li>
                            </ul>
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-end border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is('applicant.profile*') ? 'active' : '' }} ps-0"
                                                id="home-tab" href="{{ route('applicant.profile') }}" role="tab"
                                                aria-controls="overview" aria-selected="true">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                                                role="tab" aria-selected="false">Lowongan Kerja</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                href="#demographics" role="tab" aria-selected="false">Lamaran
                                                Saya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab"
                                                href="#more" role="tab" aria-selected="false">Hubungi Kami</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content tab-content-basic">
                                    @yield('content')

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">

                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('partials.applicant.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('applicant') }}/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('applicant') }}/vendors/chart.js/Chart.min.js"></script>
    <script src="{{ asset('applicant') }}/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('applicant') }}/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('applicant') }}/js/off-canvas.js"></script>
    <script src="{{ asset('applicant') }}/js/hoverable-collapse.js"></script>
    <script src="{{ asset('applicant') }}/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('applicant') }}/js/dashboard.js"></script>
    <script src="{{ asset('applicant') }}/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>