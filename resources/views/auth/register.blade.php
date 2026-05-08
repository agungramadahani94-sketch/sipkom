<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPALKOM | Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="{{ asset('sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { height: 100%; }

        body {
            min-height: 100vh;
            background: #0a0f1e;
            color: #f1f5f9;
            font-family: 'DM Sans', sans-serif;
            display: flex;
            flex-direction: column;
        }

        h1, h2, .brand { font-family: 'Syne', sans-serif; letter-spacing: -0.02em; }
        a { text-decoration: none; color: inherit; }

        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(37,99,235,0.12) 0%, transparent 65%);
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: #0d1526;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 2.5rem;
        }

        .card-head { text-align: center; margin-bottom: 2rem; }
        .card-head h2 { font-size: 1.6rem; font-weight: 800; margin-bottom: 0.35rem; }
        .card-head p { font-size: 0.85rem; color: #64748b; }

        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.4rem; font-weight: 500; }

        input {
            width: 100%;
            padding: 0.7rem 1rem;
            background: #111827;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            color: #f1f5f9;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input::placeholder { color: #334155; }
        input:focus { border-color: rgba(59,130,246,0.5); }
        input.is-invalid { border-color: rgba(239,68,68,0.5); }
        .error-msg { font-size: 0.75rem; color: #f87171; margin-top: 0.35rem; }

        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background: #2563eb;
            color: #fff;
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 0.5rem;
        }
        .btn-submit:hover { background: #3b82f6; }

        .divider {
            display: flex; align-items: center; gap: 0.75rem;
            margin: 1.5rem 0;
            color: #1e293b; font-size: 0.8rem;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: rgba(255,255,255,0.06);
        }

        .link-login { text-align: center; font-size: 0.82rem; color: #64748b; }
        .link-login a { color: #60a5fa; font-weight: 500; }
        .link-login a:hover { color: #93c5fd; }

        footer {
            text-align: center;
            padding: 1.25rem;
            font-size: 0.75rem;
            color: #1e293b;
            border-top: 1px solid rgba(255,255,255,0.04);
        }
    </style>
</head>
<body>

<main>
    <div class="card">
        <div class="card-head">
            <h2>Buat Akun</h2>
            <p>Daftar ke sistem SIPALKOM</p>
        </div>

        <form action="{{ route('registerProses') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('nama') }}"
                    class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    placeholder="email@institusi.ac.id"
                    value="{{ old('email') }}"
                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_tlp">No HP</label>
                <input type="text" id="no_tlp" name="no_tlp"
                    placeholder="08xxxxxxxxxx"
                    value="{{ old('no_tlp') }}"
                    class="{{ $errors->has('no_tlp') ? 'is-invalid' : '' }}">
                @error('no_tlp')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    placeholder="••••••••"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Daftar →</button>
        </form>

        <div class="divider">atau</div>

        <div class="link-login">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a>
        </div>
    </div>
</main>

<footer>© 2026 SIPALKOM — Sistem Peminjaman Alat Laboratorium Komputer</footer>

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