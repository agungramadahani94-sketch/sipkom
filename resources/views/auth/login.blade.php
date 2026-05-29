<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPALKOM | Login</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <!-- SweetAlert -->
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            background: #fafaf7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wrap {
            width: 100%;
            max-width: 420px;
            border: 2.5px solid #0a0a0a;
            box-shadow: 8px 8px 0 #0a0a0a;
            background: #fff;
            padding: 35px 30px;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo span {
            background: #f5c518;
            padding: 8px 20px;
            border: 2px solid #000;
            box-shadow: 3px 3px 0 #000;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            letter-spacing: 2px;
            text-align: center;
        }

        .logo small {
            font-size: 8px;
            display: block;
            margin-top: 2px;
            text-transform: uppercase;
        }

        .title {
            text-align: center;
            margin-bottom: 25px;
        }

        .title h2 {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 24px;
        }

        .title p {
            font-size: 13px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 6px;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 11px;
            border: 2px solid #000;
            box-shadow: 3px 3px 0 #000;
            outline: none;
        }

        .form-input:focus {
            transform: translate(-1px, -1px);
            box-shadow: 4px 4px 0 #000;
        }

        .is-invalid {
            border-color: red;
            box-shadow: 3px 3px 0 red;
        }

        .error-msg {
            font-size: 11px;
            color: red;
            margin-top: 4px;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background: #f5c518;
            border: 2px solid #000;
            box-shadow: 4px 4px 0 #000;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #000;
        }

        .divider {
            text-align: center;
            margin: 18px 0;
            font-size: 12px;
            color: #aaa;
        }

        hr {
            margin-bottom: 15px;
        }

        .link-register {
            text-align: center;
            font-size: 13px;
            margin-top: 8px;
        }

        .link-register a {
            color: #1640d4;
            font-weight: bold;
            text-decoration: none;
        }

        .link-register a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="wrap">

        <!-- Logo -->
        <div class="logo user-select-none">
            <span>
                LOGIN CUY
                <small>SIPALKOM</small>
            </span>
        </div>

        <!-- Form -->
        <form action="{{ route('loginProses') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="email@contoh.com">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="••••••">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="ti ti-login"></i> Masuk
            </button>
        </form>

        <!-- Divider -->
        <div class="divider">atau</div>
        <hr>

        <!-- Links -->
        <div class="link-register">
            <p>
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar</a>
            </p>
        </div>

        <div class="link-register">
            <p>
                Kembali ke →
                <a href="{{ route('landingpage.welcome') }}">Beranda</a>
            </p>
        </div>

    </div>

    <!-- Alerts -->
    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Sukses',
                text: "{{ session('success') }}",
                icon: 'success'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                title: 'Gagal',
                text: "{{ session('error') }}",
                icon: 'error'
            });
        </script>
    @endif

</body>

</html>