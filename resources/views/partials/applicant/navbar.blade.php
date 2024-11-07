<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>XYZ Recruitment </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="{{ asset('applicant') }}/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    {{-- <link rel="stylesheet" href="{{ asset('applicant') }}/js/select.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('applicant') }}/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="{{ asset('custom') }}/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="/resources/demos/style.css"> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                PT XYZ tidak memungut biaya apapun selama proses pendaftaran dan seleksi karir berlangsung.
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
                            <a href="{{ route('auth.logout') }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Keluar</a>
                        
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
                                <div class="alert alert-success text-dark" role="alert">
                                    {{ session('success') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>.
                                </div>
                            @endif
                            
                            <ul class="navbar-nav">
                                @if (!Auth::guard('user')->user()->user_detail)
                                    <div class="alert alert-warning" style="color: black" role="alert">
                                        <strong>Peringatan!</strong> Kamu belum melengkapi profile kamu, mohon lengkapi
                                        profile agar dapat melakukan pendaftaran.
                                        <a href="{{ route('applicant.profile.info') }}" class="alert-link">Klik
                                            Disini</a>
                                    </div>
                                @endif
                                {{-- <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                                    <h4 class="welcome-text">Good Morning, <span
                                            class="text-black fw-bold">{{ Auth::guard('user')->user()->email }}</span>
                                    </h4>
                                </li> --}}
                            </ul>
                            <div class="home-tab">
                                <div class="d-sm-flex align-items-center justify-content-end border-bottom">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is('applicant.profile*') ? 'active' : '' }} ps-0"
                                                id="home-tab" href="{{ route('applicant.profile.info') }}"
                                                role="tab" aria-controls="overview" aria-selected="true">Profile</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is('applicant.job*') ? 'active' : '' }}" href="{{ route('applicant.job') }}"
                                                role="tab" aria-selected="false">Lowongan Kerja</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is('applicant.application*') ? 'active' : '' }}" href="{{ route('applicant.application') }}" role="tab" aria-selected="false">Lamaran
                                                Saya</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ Route::is('applicant.password*') ? 'active':''}} border-0"  href="{{ route('applicant.password') }}" role="tab" aria-selected="false">Password</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    
    @stack('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        $(function() {
            $('#datepicker').datepicker();

            $('#datepicker1').datepicker();
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <!-- End custom js for this page-->
</body>

</html>
