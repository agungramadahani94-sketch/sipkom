<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPALKOM | Register</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">

    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background: #fafaf7;
            font-family: 'DM Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .wrap {
            width: 100%;
            max-width: 420px;
            border: 2.5px solid #000;
            box-shadow: 8px 8px 0 #000;
            background: #fff;
            padding: 35px 30px;
        }

        /* LOGO KUNING (SAMA PERSIS LOGIN) */
        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo span {
            background: #f5c518;
            padding: 10px 22px;
            border: 2px solid #000;
            box-shadow: 4px 4px 0 #000;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            letter-spacing: 2px;
            text-align: center;
        }

        .logo small {
            display: block;
            font-size: 10px;
            margin-top: 2px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 6px;
            display: block;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 2px solid #000;
            box-shadow: 3px 3px 0 #000;
            outline: none;
        }

        input:focus {
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

        .password-wrap {
            position: relative;
        }

        .toggle-pass {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 13px;
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

        .link-login {
            text-align: center;
            font-size: 13px;
        }

        .link-login a {
            color: #1640d4;
            font-weight: bold;
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

        <!-- LOGO -->
        <div class="user-select-none logo">
            <span>
                REGISTER CUY
                <small>SIPALKOM</small>
            </span>
        </div>

        <form action="{{ route('registerProses') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap"
                    class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_tlp" value="{{ old('no_tlp') }}" placeholder="08xxxxxxxxxx"
                    class="{{ $errors->has('no_tlp') ? 'is-invalid' : '' }}">
                @error('no_tlp')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-wrap">
                    <input type="password" id="password" name="password" placeholder="••••••"
                        class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                </div>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn-submit" onclick="window.location.href='/login'">
                Daftar
            </button>

        </form>

        <div class="divider">atau</div>

        <div class="link-login">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>



    </div>

    <script>
        function togglePassword() {
            let input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({ title: 'Sukses', text: "{{ session('success') }}", icon: 'success' });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({ title: 'Gagal', text: "{{ session('error') }}", icon: 'error' });
        </script>
    @endif

</body>

</html>