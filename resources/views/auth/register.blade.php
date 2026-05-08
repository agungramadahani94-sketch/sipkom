<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Tugas | Register</title>

    <!-- CSS -->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">

                        <!-- Judul -->
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">
                                <i class="fas fa-user-plus"></i> Register
                            </h1>
                        </div>

                        <!-- Form Register -->
                      <form class="user" action="{{ route('registerProses') }}" method="POST">
                            @csrf

                            <!-- Nama -->
                            <div class="form-group">
                                <input type="text" name="nama"
                                    class="form-control form-control-user @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('nama') }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <input type="email" name="email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    placeholder="Masukkan Email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- No HP -->
                            <div class="form-group">
                                <input type="text" name="no_tlp"
                                    class="form-control form-control-user @error('no_tlp') is-invalid @enderror"
                                    placeholder="Masukkan No HP" value="{{ old('no_tlp') }}">
                                @error('no_tlp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <input type="password" name="password"
                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Button -->
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Daftar
                            </button>
                        </form>

                        <hr>

                        <!-- Link -->
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Sudah punya akun? Login</a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>