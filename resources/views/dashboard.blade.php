<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>SILAU | Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/logoDishub.png') }}">

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .bg-gradient-primary {
            background: linear-gradient(180deg, #0b5ed7 10%, #0dcaf0 100%);
        }

        .sidebar {
            background: #0b5ed7;
        }
    </style>

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('logo/logoDishub.png') }}" width="35" class="mr-2">
                <div class="sidebar-brand-text text-left">
                    <div class="font-weight-bold">SILAU</div>
                    <div style="font-size:11px; line-height:12px;">Dinas Perhubungan</div>
                </div>
            </a>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Navigation
            </div>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengaduan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Pengaduan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-flex align-items-center">
                        <img src="{{ asset('logo/logoSumedang.jpg') }}" width="45" class="mr-2">
                        <div class="d-none d-md-block">
                            <div class="font-weight-bold text-primary" style="font-size:14px;">
                                KABUPATEN SUMEDANG
                            </div>
                            <div style="font-size:11px; color:#6c757d;">
                                Sistem Informasi Layanan Aduan (SILAU)
                            </div>
                        </div>
                    </div>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ auth()->user()->name ?? 'Admin' }}
                                </span>
                                <i class="fas fa-user-circle fa-lg"></i>
                            </a>
                        </li>
                    </ul>

                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Status Masuk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jumlahMasuk }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Status Proses</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jumlahProses }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Status Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jumlahSelesai }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Pengaduan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $totalPengaduan }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4 border-left-primary">
                                <div class="card-body text-center py-5">

                                    <h4 class="font-weight-bold text-primary mb-2">
                                        SELAMAT DATANG DI SISTEM SILAU
                                    </h4>
                                    <p class="text-muted mb-0">
                                        Sistem Informasi Layanan Aduan Dinas Perhubungan Kabupaten Sumedang
                                    </p>

                                    <p class="text-gray-700 mb-2">
                                        Anda berhasil login ke sistem.
                                    </p>

                                    <p class="text-muted">
                                        Silakan gunakan menu di sebelah kiri untuk mengelola data dan fitur yang
                                        tersedia.
                                    </p>

                                    <hr class="my-4">

                                    <p class="small text-gray-600 mb-0">
                                        Login sebagai:
                                        <strong>{{ auth()->user()->name ?? 'User' }}</strong>
                                    </p>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart" data-masuk="{{ $jumlahMasuk }}"
                                            data-proses="{{ $jumlahProses }}" data-selesai="{{ $jumlahSelesai }}">
                                        </canvas>

                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Masuk
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Proses
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Selesai
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>
                            © {{ date('Y') }} SILAU - Pemerintah Kabupaten Sumedang
                        </span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt"></i> Konfirmasi Logout
                    </h5>
                    <button class="close text-white" type="button" data-dismiss="modal">
                        <span>×</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    Apakah Anda yakin ingin keluar dari sistem?
                </div>

                <div class="modal-footer justify-content-center">

                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            Ya, Logout
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('sbadmin/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('sbadmin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('sbadmin/js/demo/chart-pie-demo.js') }}"></script>

</body>

</html>