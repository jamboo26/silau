<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SILAU | Register</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/logoDishub.png') }}">

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0b5ed7, #0dcaf0);
            position: relative;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.15;
            filter: blur(2px);
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            background: #ffffff;
            top: -100px;
            left: -100px;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            background: #ffffff;
            bottom: -80px;
            right: -80px;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            background: #ffffff;
            bottom: 120px;
            left: 60px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 18px;
        }

        .text-shadow {
            text-shadow: 0 2px 6px rgba(0, 0, 0, .35);
        }
    </style>
</head>

<body class="bg-light">

    <div class="bg-circle circle-1"></div>
    <div class="bg-circle circle-2"></div>
    <div class="bg-circle circle-3"></div>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;">

            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">

                <div class="text-center mb-4">
                    <img src="{{ asset('logo/logoSumedang.jpg') }}" height="70" class="mr-2 shadow-sm rounded">
                    <img src="{{ asset('logo/logoDishub.png') }}" height="70" class="shadow-sm rounded">

                    <h5 class="mt-3 font-weight-bold text-white text-shadow">
                        SISTEM INFORMASI LAMPU JALAN UMUM (SILAU)
                    </h5>
                    <small class="text-white d-block text-shadow">
                        UPTD Penerangan Jalan Umum
                    </small>
                    <small class="text-white d-block text-shadow">
                        Dinas Perhubungan Kabupaten Sumedang
                    </small>
                </div>

                <div class="card border-0 shadow-lg rounded-lg">
                    <div class="card-body p-5">

                        <h5 class="text-center text-gray-800 mb-4 font-weight-bold">Registrasi Akun Petugas</h5>

                        @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="small text-muted">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control form-control-lg"
                                    placeholder="Masukkan Nama Lengkap" required>
                            </div>

                            <div class="form-group">
                                <label class="small text-muted">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg"
                                    placeholder="Masukkan Email" required>
                            </div>

                            <div class="form-group">
                                <label class="small text-muted">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg"
                                    placeholder="Masukkan Password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">
                                <i class="fas fa-user-plus"></i> Daftar
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <a href="{{ route('login') }}" class="small text-primary">
                                Sudah punya akun? Login
                            </a>
                        </div>

                    </div>
                </div>

                <div class="text-center mt-4 text-white small text-shadow">
                    © {{ date('Y') }} SILAU - Pemerintah Kabupaten Sumedang
                </div>

            </div>

        </div>
    </div>

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>


</html>