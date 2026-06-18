<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>SILAU | Pengaduan</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/logoDishub.png') }}">

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.15/dist/css/bootstrap-multiselect.css">

    <style>
        .multiselect-native-select .btn {
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: .9rem;
            border-radius: .35rem;
        }

        .multiselect-native-select .multiselect-container {
            width: 100%;
        }

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

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Data Pengaduan</h1>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success text-center">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filter Pengaduan</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('pengaduan') }}" class="form-row align-items-end">

                                <div class="form-group col-md-3">
                                    <label>Tanggal Dari</label>
                                    <input type="date" name="tanggal_dari" class="form-control"
                                        value="{{ $tanggalDari }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Tanggal Sampai</label>
                                    <input type="date" name="tanggal_sampai" class="form-control"
                                        value="{{ $tanggalSampai }}">
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Status Pengaduan</label>
                                    <select id="status_filter" name="status[]" multiple>
                                        <option value="Masuk" {{ in_array('Masuk', $status) ? 'selected' : '' }}>Masuk
                                        </option>
                                        <option value="Proses" {{ in_array('Proses', $status) ? 'selected' : '' }}>
                                            Proses</option>
                                        <option value="Selesai" {{ in_array('Selesai', $status) ? 'selected' : '' }}>
                                            Selesai</option>
                                        <option value="Tidak Terselesaikan" {{ in_array('Tidak Terselesaikan', $status) ? 'selected' : '' }}>
                                            Tidak Terselesaikan</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Terapkan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Semua Data Pengaduan</h6>

                            <form action="{{ route('pengaduan.print') }}" method="POST" target="_blank" id="formPrint">
                                @csrf
                                <input type="hidden" name="ids" id="printIds">
                                <button type="submit" class="btn btn-danger btn-sm float-right">
                                    <i class="fas fa-file-pdf"></i> Download PDF
                                </button>
                            </form>

                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Laporan</th>
                                            <th>Nama</th>
                                            <th>Jenis Pengaduan</th>
                                            <th>Deskripsi</th>
                                            <th>Lokasi</th>
                                            <th>Gambar</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Foto Selesai</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($pengaduan as $item)
                                        <tr data-id="{{ $item->id }}">

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->id_laporan }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenis_pengaduan }}</td>
                                            <td>{{ $item->deskripsi }}</td>

                                            <td class="text-center">
                                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                                    target="_blank" class="btn btn-sm btn-info">
                                                    <i class="fas fa-map-marker-alt"></i> Lihat
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                @if ($item->gambar)
                                                <img src="http://localhost:3000/{{ $item->gambar }}" width="80"
                                                    class="img-thumbnail">
                                                @else
                                                <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>

                                            <td>{{ $item->waktu }}</td>

                                            <td>
                                                @if ($item->status == 'Masuk')
                                                <span class="badge badge-primary">Masuk</span>
                                                @elseif ($item->status == 'Proses')
                                                <span class="badge badge-success">Proses</span>
                                                @elseif ($item->status == 'Tidak Terselesaikan')
                                                <span class="badge badge-danger">Tidak<br>Terselesaikan</span>
                                                @else
                                                <span class="badge badge-info">Selesai</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                @if ($item->foto)
                                                <img src="{{ asset('foto/'.$item->foto) }}" width="80"
                                                    class="img-thumbnail">
                                                @else
                                                <span class="text-muted">Belum selesai</span>
                                                @endif
                                            </td>

                                            <td class="text-center">

                                                <a href="{{ route('pengaduan.show', $item->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">
                                                Tidak ada data pengaduan
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        © {{ date('Y') }} SILAU - Pemerintah Kabupaten Sumedang
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

    <script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('sbadmin/js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-multiselect@0.9.15/dist/js/bootstrap-multiselect.min.js">
    </script>

    <script>
        document.getElementById('formPrint').addEventListener('submit', function() {
            let ids = [];

            document.querySelectorAll('#dataTable tbody tr').forEach(function(row) {
                const id = row.getAttribute('data-id');
                if (id) ids.push(id);
            });

            document.getElementById('printIds').value = JSON.stringify(ids);
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#status_filter').multiselect({
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                includeSelectAllOption: true,
                selectAllText: 'Select All',

                allSelectedText: 'Semua status dipilih',

                nonSelectedText: 'Pilih Status',
                nSelectedText: 'status dipilih',
                numberDisplayed: 3,

                buttonWidth: '100%',
                maxHeight: 300,
                buttonClass: 'btn btn-light border form-control text-left'
            });

            $('#applyFilter').on('click', function() {
                const tanggalDari = $('#tanggal_dari').val();
                const tanggalSampai = $('#tanggal_sampai').val();
                const status = $('#status_filter').val();

                console.log({
                    tanggalDari,
                    tanggalSampai,
                    status
                });
            });

        });
    </script>

</body>

</html>