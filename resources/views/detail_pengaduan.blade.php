<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <title>SILAU | Detail Pengaduan</title>
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
        .detail-label {
            font-size: 0.85rem;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
        }

        .detail-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        .detail-card img {
            max-height: 320px;
            object-fit: contain;
            width: 100%;
            border-radius: .5rem;
        }

        .chat-body {
            max-height: 350px;
            overflow-y: auto;
            background: #f8f9fc;
            padding: 15px;
        }

        .chat-message {
            display: flex;
            flex-direction: column;
            margin-bottom: 12px;
        }

        .chat-message.left {
            align-items: flex-start;
        }

        .chat-message.right {
            align-items: flex-end;
        }

        .chat-message.center {
            align-items: center;
        }

        .chat-bubble {
            max-width: 75%;
            padding: 10px 14px;
            border-radius: 15px;
            font-size: 0.9rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, .1);
        }

        .chat-message.right .chat-bubble {
            border-bottom-right-radius: 0;
        }

        .chat-message.left .chat-bubble {
            border-bottom-left-radius: 0;
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
                        <h1 class="h3 mb-0 text-gray-800">Detail Pengaduan</h1>
                    </div>

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="row">

                        <div class="col-lg-7">
                            <div class="card shadow mb-4 detail-card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="m-0 font-weight-bold">Informasi Pengaduan</h6>
                                </div>
                                <div class="card-body">

                                    <div class="mb-3">
                                        <div class="detail-label">ID Laporan</div>
                                        <div class="detail-value">{{ $pengaduan->id_laporan }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Nama Pelapor</div>
                                        <div class="detail-value">{{ $pengaduan->nama }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Jenis Pengaduan</div>
                                        <div class="detail-value">{{ $pengaduan->jenis_pengaduan }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Deskripsi</div>
                                        <div class="detail-value">{{ $pengaduan->deskripsi }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Waktu Laporan</div>
                                        <div class="detail-value">{{ $pengaduan->waktu }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Lokasi (Google Maps)</div>
                                        <div class="detail-value">
                                            <a href="https://www.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}"
                                                target="_blank">
                                                https://www.google.com/maps?q={{ $pengaduan->latitude }},{{ $pengaduan->longitude }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="detail-label">Nomor Kontak</div>
                                        <div class="detail-value">
                                            {{ $pengaduan->nomor_hp }}
                                            <a href="https://wa.me/62{{ ltrim($pengaduan->nomor_hp, '0') }}"
                                                target="_blank" class="ml-2 text-success">
                                                <i class="fab fa-whatsapp"></i> Hubungi
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="m-0 font-weight-bold">Status Pengaduan</h6>
                                </div>
                                <div class="card-body">

                                    <div class="mb-3 text-center">
                                        @if ($pengaduan->status == 'Masuk')
                                        <span class="badge badge-primary p-2">Masuk</span>
                                        @elseif ($pengaduan->status == 'Proses')
                                        <span class="badge badge-success p-2">Proses</span>
                                        @elseif ($pengaduan->status == 'Tidak Terselesaikan')
                                        <span class="badge badge-danger p-2">Tidak Terselesaikan</span>
                                        @else
                                        <span class="badge badge-info p-2">Selesai</span>
                                        @endif
                                    </div>

                                    @if($pengaduan->status == 'Tidak Terselesaikan' && $pengaduan->alasan)
                                    <div class="alert alert-danger">
                                        <strong>Alasan Tidak Terselesaikan:</strong><br>
                                        {{ $pengaduan->alasan }}
                                    </div>
                                    @endif

                                    <form id="formStatus" action="{{ route('pengaduan.updateStatus', $pengaduan->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label>Ubah Status</label>
                                            <select name="status" id="statusSelect" class="form-control">
                                                <option value="Masuk"
                                                    {{ $pengaduan->status == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                                                <option value="Proses"
                                                    {{ $pengaduan->status == 'Proses' ? 'selected' : '' }}>Proses
                                                </option>
                                                <option value="Selesai"
                                                    {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                                <option value="Tidak Terselesaikan"
                                                    {{ $pengaduan->status == 'Tidak Terselesaikan' ? 'selected' : '' }}>Tidak Terselesaikan
                                                </option>
                                            </select>

                                            <div id="alasanWrapper" class="mt-3 d-none">
                                                <label class="font-weight-bold text-danger">Alasan Tidak Terselesaikan</label>
                                                <textarea name="alasan" class="form-control" placeholder="Masukkan alasan mengapa laporan tidak bisa diselesaikan...">{{ $pengaduan->alasan }}</textarea>
                                            </div>

                                            <div id="previewWrapper" class="mt-3 d-none text-center">
                                                <label class="font-weight-bold text-success">Preview Foto
                                                    Penyelesaian</label>
                                                <div class="mt-2">
                                                    <img id="previewFoto" src="" class="img-fluid rounded shadow"
                                                        style="max-height:200px;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group d-none" id="inputFoto">
                                            <label>Upload Foto Bukti Penyelesaian</label>
                                            <input type="file" name="foto" id="fotoHidden" class="d-none"
                                                accept="image/*">
                                        </div>

                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="fas fa-sync-alt"></i> Update Status
                                        </button>
                                    </form>

                                </div>
                            </div>

                            @if(!empty($pengaduan->foto))
                            <div class="card shadow mb-4 detail-card">
                                <div class="card-header bg-success text-white">
                                    <h6 class="m-0 font-weight-bold">
                                        <i class="fas fa-camera"></i> Foto Penyelesaian
                                    </h6>
                                </div>
                                <div class="card-body text-center">

                                    <img src="{{ asset('foto/'.$pengaduan->foto) }}" class="img-fluid rounded shadow"
                                        style="max-height:300px; object-fit:contain;">

                                    <div class="mt-2 text-muted small">
                                        Foto bukti pekerjaan telah selesai
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="col-lg-5">
                            <div class="card shadow mb-4 detail-card">
                                <div class="card-header bg-secondary text-white">
                                    <h6 class="m-0 font-weight-bold">Bukti Gambar</h6>
                                </div>
                                <div class="card-body text-center">

                                    @if ($pengaduan->gambar)
                                    <img src="http://localhost:3000/{{ $pengaduan->gambar }}" alt="Bukti Pengaduan">
                                    @else
                                    <p class="text-muted">Tidak ada gambar</p>
                                    @endif

                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div
                                    class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold">Riwayat Pesan</h6>

                                    @if($pengaduan->is_connected)
                                    <form action="{{ route('pengaduan.disconnectChat', $pengaduan->id) }}"
                                        method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-unlink"></i> Putuskan Chat
                                        </button>
                                    </form>

                                    @elseif($pengaduan->status == 'Proses')
                                    <form action="{{ route('pengaduan.connectChat', $pengaduan->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-link"></i> Hubungkan ke User
                                        </button>
                                    </form>

                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>
                                        <i class="fas fa-lock"></i> Tidak Bisa Dihubungkan
                                    </button>
                                    @endif
                                </div>

                                <div class="card-body chat-body" id="chatBody">

                                    @forelse ($chats as $chat)

                                    @if ($chat->user == 1)
                                    <div class="chat-message left">
                                        <div class="chat-bubble bg-light">
                                            <small class="text-muted d-block mb-1">Pelapor</small>
                                            {{ $chat->user_chat }}
                                        </div>
                                        <small class="text-muted mt-1">
                                            {{ \Carbon\Carbon::parse($chat->waktu)->format('H:i') }}
                                        </small>
                                    </div>

                                    @else
                                    <div class="chat-message right">
                                        <div class="chat-bubble bg-success text-white">
                                            <small class="d-block mb-1">
                                                Petugas ({{ $chat->nama_petugas ?? 'Petugas' }})
                                            </small>
                                            {{ $chat->petugas_chat }}
                                        </div>
                                        <small class="text-muted mt-1">
                                            {{ \Carbon\Carbon::parse($chat->waktu)->format('H:i') }}
                                        </small>
                                    </div>
                                    @endif

                                    @empty
                                    <div class="text-center text-muted">
                                        Belum ada pesan untuk pengaduan ini.
                                    </div>
                                    @endforelse
                                </div>

                                @if($pengaduan->is_connected)
                                <form action="{{ route('pengaduan.sendChat', $pengaduan->id) }}" method="POST">
                                    @csrf
                                    <div class="card-footer">
                                        <div class="input-group">
                                            <input type="text" name="pesan" class="form-control"
                                                placeholder="Ketik pesan..." required>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @else
                                <div class="card-footer text-center text-muted">
                                    @if($pengaduan->status != 'Proses')
                                    Status pengaduan harus <b>Proses</b> untuk bisa menghubungkan chat.
                                    @else
                                    Chat belum dihubungkan dengan user
                                    @endif
                                </div>
                                @endif
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

    <div class="modal fade" id="modalFoto" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Upload Foto Penyelesaian</h5>
                </div>

                <div class="modal-body text-center">
                    <p class="text-muted mb-2">
                        Pilih foto, modal akan otomatis tertutup
                    </p>

                    <input type="file" id="fotoModal" class="form-control" accept="image/*">
                </div>

            </div>
        </div>
    </div>

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
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

    <script>
        const statusSelect = document.getElementById("statusSelect");
        const fotoModal = document.getElementById("fotoModal");
        const fotoHidden = document.getElementById("fotoHidden");
        const previewWrapper = document.getElementById("previewWrapper");
        const previewFoto = document.getElementById("previewFoto");
        const alasanWrapper = document.getElementById("alasanWrapper");

        statusSelect.addEventListener("change", function() {
            if (this.value === "Selesai") {
                $('#modalFoto').modal('show');
                alasanWrapper.classList.add("d-none");
            } else if (this.value === "Tidak Terselesaikan") {
                alasanWrapper.classList.remove("d-none");
                previewWrapper.classList.add("d-none");
            } else {
                previewWrapper.classList.add("d-none");
                alasanWrapper.classList.add("d-none");
                previewFoto.src = "";
                fotoHidden.value = "";
            }
        });

        fotoModal.addEventListener("change", function() {
            const file = this.files[0];

            if (!file) return;

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fotoHidden.files = dataTransfer.files;

            const reader = new FileReader();
            reader.onload = function(e) {
                previewFoto.src = e.target.result;
                previewWrapper.classList.remove("d-none");
            };
            reader.readAsDataURL(file);

            $('#modalFoto').modal('hide');
        });
    </script>


    <script>
        function scrollChatToBottom() {
            const chatBody = document.getElementById("chatBody");
            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            scrollChatToBottom();
        });

        const chatForm = document.querySelector("form[action*='sendChat']");
        if (chatForm) {
            chatForm.addEventListener("submit", function() {
                setTimeout(scrollChatToBottom, 300);
            });
        }
    </script>

    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>

    <script>
        const ID_LAPORAN = "{{ $pengaduan->id_laporan }}";

        const socket = io("http://localhost:3000", {
            transports: ["websocket"]
        });

        socket.on("connect", () => {
            console.log("✅ Socket connected");
            socket.emit("join_laporan", ID_LAPORAN);
        });

        socket.on("chat_baru", function(data) {
            appendChat(data);
        });

        function appendChat(data) {
            const chatBody = document.getElementById("chatBody");

            const div = document.createElement("div");
            div.className = "chat-message " + (data.user == 1 ? "left" : "right");

            const bubble = document.createElement("div");
            bubble.className = "chat-bubble " + (data.user == 1 ? "bg-light" : "bg-success text-white");

            const label = document.createElement("small");
            label.className = data.user == 1 ?
                "text-muted d-block mb-1" :
                "d-block mb-1";

            label.innerText = data.user == 1 ?
                "Pelapor" :
                `Petugas (${data.petugas ?? 'Petugas'})`;

            const text = document.createElement("div");
            text.innerText = data.pesan;

            bubble.appendChild(label);
            bubble.appendChild(text);
            div.appendChild(bubble);

            const time = document.createElement("small");
            time.className = "text-muted mt-1";
            time.innerText = new Date(data.waktu).toLocaleTimeString();

            div.appendChild(time);

            chatBody.appendChild(div);

            scrollChatToBottom();
        }
    </script>

</body>

</html>