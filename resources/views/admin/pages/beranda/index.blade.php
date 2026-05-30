@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">

                {{-- HERO --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="db-hero">
                            <div class="db-hero-left">
                                <div class="db-hero-badge">
                                    <i class="fas fa-shield-alt"></i> Dashboard Admin
                                </div>

                                <h2 class="db-hero-title">
                                    Selamat Datang, Admin 👋
                                </h2>

                                <p class="db-hero-sub">
                                    Kelola data alat, pengguna, serta transaksi peminjaman laboratorium komputer
                                    dengan lebih mudah, cepat, dan terintegrasi dalam satu dashboard.
                                </p>

                                <a href="{{ route('alatlab.index') }}" class="db-hero-btn">
                                    <i class="fas fa-laptop mr-2"></i> Kelola Data Alat
                                </a>
                            </div>

                            <div class="db-hero-deco">💻</div>
                        </div>
                    </div>
                </div>

                {{-- SECTION HEADER --}}
                <div class="db-section-hdr mb-3">
                    <span class="db-section-title">Ringkasan Sistem</span>
                    <span class="db-section-sub">
                        Update terakhir: {{ now()->translatedFormat('d F Y') }}
                    </span>
                </div>

                {{-- STATISTIK --}}
                <div class="row mb-4">

                    {{-- USER --}}
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="db-sc">
                            <div class="db-sc-ico bg-primary-soft text-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="db-sc-lbl">Total Pengguna</div>
                            <div class="db-sc-val">{{ $totalUser ?? 0 }}</div>
                            <div class="db-sc-trend text-primary">
                                Sistem aktif digunakan
                            </div>
                        </div>
                    </div>

                    {{-- ALAT --}}
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="db-sc">
                            <div class="db-sc-ico bg-info-soft text-info">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="db-sc-lbl">Total Alat</div>
                            <div class="db-sc-val">{{ $totalAlat ?? 0 }}</div>
                            <div class="db-sc-trend text-info">
                                Siap digunakan
                            </div>
                        </div>
                    </div>

                    {{-- PINJAM --}}
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="db-sc">
                            <div class="db-sc-ico bg-danger-soft text-danger">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <div class="db-sc-lbl">Peminjaman</div>
                            <div class="db-sc-val">{{ $totalPeminjaman ?? 0 }}</div>
                            <div class="db-sc-trend text-danger">
                                Total transaksi
                            </div>
                        </div>
                    </div>

                    {{-- KEMBALI --}}
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="db-sc">
                            <div class="db-sc-ico bg-success-soft text-success">
                                <i class="fas fa-undo"></i>
                            </div>
                            <div class="db-sc-lbl">Pengembalian</div>
                            <div class="db-sc-val">{{ $totalPengembalian ?? 0 }}</div>
                            <div class="db-sc-trend text-success">
                                Sudah dikembalikan
                            </div>
                        </div>
                    </div>

                </div>

                {{-- AKSES CEPAT --}}
                <div class="db-section-hdr mb-3">
                    <span class="db-section-title">Menu Cepat</span>
                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <a href="{{ route('alatlab.index') }}" class="db-qc">
                            <i class="fas fa-laptop"></i>
                            <span>Kelola Alat</span>
                        </a>
                    </div>

                    <div class="col-md-3 mb-3">
                        <a href="#" class="db-qc">
                            <i class="fas fa-users"></i>
                            <span>Kelola User</span>
                        </a>
                    </div>

                    <div class="col-md-3 mb-3">
                        <a href="#" class="db-qc">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Peminjaman</span>
                        </a>
                    </div>

                    <div class="col-md-3 mb-3">
                        <a href="#" class="db-qc">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan</span>
                        </a>
                    </div>

                </div>

            </div>
        </section>
    </div>

    <style>
        /* HERO */
        .db-hero {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            padding: 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .db-hero-title {
            font-size: 24px;
            font-weight: 700;
        }

        .db-hero-sub {
            font-size: 14px;
            opacity: 0.9;
            margin: 10px 0 20px;
        }

        .db-hero-btn {
            background: white;
            color: #667eea;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
        }

        .db-hero-btn:hover {
            background: #f1f1f1;
        }

        .db-hero-deco {
            font-size: 70px;
            opacity: 0.2;
        }

        /* STAT CARD */
        .db-sc {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: left;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .db-sc-val {
            font-size: 28px;
            font-weight: bold;
        }

        /* QUICK MENU */
        .db-qc {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            justify-content: center;
            transition: 0.2s;
        }

        .db-qc:hover {
            background: #667eea;
            color: white;
        }
    </style>
@endsection