@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header shadow-sm">
            <h1>Dashboard</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">User</a></div>
                <div class="breadcrumb-item">Dashboard</div>
            </div>
        </div>

        <div class="section-body">
            {{-- WELCOME CARD --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary mb-4 shadow-sm border-0">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between" 
                             style="background: linear-gradient(90deg, #6777ef 0%, #acb5f6 100%); border-radius: 12px;">
                            <div class="text-white">
                                <h4 class="mb-1">Halo, <b>{{ auth()->user()->nama }}</b>! 👋</h4>
                                <p class="mb-0 opacity-8">Selamat datang di <strong>SIPALKOM</strong>. Cari dan pinjam alat laboratorium dengan cepat.</p>
                            </div>
                            <div class="d-none d-md-block">
                                <img src="https://cdn-icons-png.flaticon.com/512/6213/6213825.png" alt="welcome" width="80">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- STATISTIC 1 --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-sm border-0">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sedang Dipinjam</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalDipinjam ?? 0 }} <small class="text-muted" style="font-size: 12px">Alat</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATISTIC 2 --}}
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1 shadow-sm border-0">
                        <div class="card-icon bg-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Selesai</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKembali ?? 0 }} <small class="text-muted" style="font-size: 12px">Selesai</small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEARCH CARD (Ganti Menu Cepat) --}}
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="card shadow-sm border-0" style="height: 102px;"> {{-- Tinggi disamakan dengan card statistic --}}
                        <div class="card-body d-flex align-items-center">
                            <form action="{{ route('user.alat') }}" method="GET" class="w-100">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control border-light bg-light" placeholder="Cari alat (misal: Laptop, Mouse...)" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION SHORTCUTS --}}
            <h2 class="section-title">Akses Cepat</h2>
            <p class="section-lead">Pilih menu di bawah untuk navigasi lebih lanjut.</p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-large-icons shadow-sm border-0 transition-hover">
                        <div class="card-icon bg-primary text-white">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div class="card-body">
                            <h4>Katalog Alat</h4>
                            <p>Cari dan pilih alat laboratorium yang tersedia untuk dipinjam.</p>
                            <a href="{{ route('user.alat') }}" class="card-cta">Lihat Katalog <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-large-icons shadow-sm border-0 transition-hover">
                        <div class="card-icon bg-info text-white">
                            <i class="fas fa-history"></i>
                        </div>
                        <div class="card-body">
                            <h4>Riwayat Pinjam</h4>
                            <p>Pantau status peminjaman dan batas waktu pengembalian alat.</p>
                            <a href="{{ route('user.peminjaman') }}" class="card-cta">Cek Status <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<style>
    /* Mengatur tinggi card agar sejajar dengan card-statistic-1 */
    .card-statistic-1 {
        height: 102px;
    }

    /* Form Search Styling */
    .input-group .form-control {
        height: 45px;
        border-radius: 8px 0 0 8px;
    }
    .input-group .btn {
        height: 45px;
        border-radius: 0 8px 8px 0;
        padding: 0 20px;
    }

    /* Action Cards */
    .card-large-icons {
        display: flex;
        flex-direction: row;
        overflow: hidden;
        border-radius: 12px;
    }
    .card-large-icons .card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        font-size: 24px;
    }
    .card-large-icons .card-body {
        padding: 20px;
    }
    .opacity-8 { opacity: 0.8; }
    .card-cta {
        font-weight: 600;
        text-decoration: none !important;
    }
    .section-title { margin-top: 30px; }

    /* Efek Hover */
    .transition-hover:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection