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
            <div class="row mb-3">
                <div class="col-12">
                    <div class="welcome-card">
                        <div>
                            <h4 class="mb-1">Halo, <b>{{ auth()->user()->nama }}</b>! 👋</h4>
                            <p class="mb-0">Selamat datang di <strong>SIPALKOM</strong>. Kelola peminjaman alat laboratorium dengan mudah.</p>
                        </div>
                        <div class="welcome-badge d-none d-md-block">SIPALKOM</div>
                    </div>
                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="row mb-3">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--blue">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <div>
                            <div class="stat-label">Sedang Dipinjam</div>
                            <div class="stat-value">{{ $totalDipinjam ?? 0 }} <span class="stat-unit">alat</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--green">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="stat-label">Selesai</div>
                            <div class="stat-value">{{ $totalKembali ?? 0 }} <span class="stat-unit">kali</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--amber">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div>
                            <div class="stat-label">Jatuh Tempo</div>
                            <div class="stat-value">{{ $totalJatuhTempo ?? 0 }} <span class="stat-unit">alat</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3 mb-lg-0">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--coral">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div>
                            <div class="stat-label">Menunggu ACC</div>
                            <div class="stat-value">{{ $totalPending ?? 0 }} <span class="stat-unit">req</span></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STATUS PEMINJAMAN AKTIF --}}
            <div class="row mb-3">
                <div class="col-12">
                    <div class="notice-card">
                        <div class="notice-header">
                            <div class="notice-title">
                                <i class="fas fa-exclamation-triangle"></i>
                                Status Peminjaman Aktif
                            </div>
                            <small class="text-muted">{{ now()->translatedFormat('d M Y') }}</small>
                        </div>

                        @forelse($peminjamanAktif ?? [] as $item)
                        <div class="notice-row">
                            <div>
                                <div class="notice-name">{{ $item->alat->nama ?? '-' }}</div>
                                <small class="text-muted">
                                    Dipinjam {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M') }} &middot;
                                    Kembali {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M') }}
                                </small>
                            </div>
                            @if(\Carbon\Carbon::parse($item->tgl_kembali)->isPast())
                                <span class="badge-status badge-danger">Terlambat</span>
                            @elseif(\Carbon\Carbon::parse($item->tgl_kembali)->diffInDays(now()) <= 2)
                                <span class="badge-status badge-warn">Segera kembali</span>
                            @else
                                <span class="badge-status badge-ok">Tepat waktu</span>
                            @endif
                        </div>
                        @empty
                        <div class="notice-empty">
                            <i class="fas fa-check-circle text-success"></i>
                            Tidak ada peminjaman aktif saat ini.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- AKSES CEPAT --}}
            <div class="section-label mb-3">Akses Cepat</div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{ route('user.alat') }}" class="menu-card d-flex align-items-start text-decoration-none">
                        <div class="menu-icon menu-icon--purple mr-3">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <div>
                            <div class="menu-title">Katalog Alat</div>
                            <div class="menu-desc">Cari dan pilih alat laboratorium yang tersedia untuk dipinjam.</div>
                            <div class="menu-cta menu-cta--purple">Lihat katalog <i class="fas fa-arrow-right fa-xs"></i></div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="{{ route('user.peminjaman') }}" class="menu-card d-flex align-items-start text-decoration-none">
                        <div class="menu-icon menu-icon--teal mr-3">
                            <i class="fas fa-history"></i>
                        </div>
                        <div>
                            <div class="menu-title">Riwayat Pinjam</div>
                            <div class="menu-desc">Pantau status peminjaman dan batas waktu pengembalian alat.</div>
                            <div class="menu-cta menu-cta--teal">Cek status <i class="fas fa-arrow-right fa-xs"></i></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>
</div>

<style>
.welcome-card {
    background: linear-gradient(135deg, #3B4FD8 0%, #6C7FFF 60%, #A78BFA 100%);
    border-radius: 14px;
    padding: 1.5rem 2rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    overflow: hidden;
    position: relative;
}
.welcome-card::before {
    content: '';
    position: absolute;
    right: -30px; top: -40px;
    width: 180px; height: 180px;
    border-radius: 50%;
    background: rgba(255,255,255,0.07);
}
.welcome-card h4, .welcome-card p { color: #fff; }
.welcome-card p { opacity: 0.82; font-size: 14px; }
.welcome-badge {
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.28);
    border-radius: 10px;
    padding: 8px 18px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    white-space: nowrap;
    position: relative;
    z-index: 1;
}

.stat-card {
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 14px;
    padding: 1.1rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.stat-icon {
    width: 46px; height: 46px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.stat-icon--blue  { background: #E6F1FB; color: #185FA5; }
.stat-icon--green { background: #EAF3DE; color: #3B6D11; }
.stat-icon--amber { background: #FAEEDA; color: #854F0B; }
.stat-icon--coral { background: #FAECE7; color: #993C1D; }
.stat-label { font-size: 12px; color: #888; margin-bottom: 2px; }
.stat-value { font-size: 22px; font-weight: 600; color: #2d2d2d; line-height: 1; }
.stat-unit  { font-size: 11px; color: #aaa; }

.notice-card {
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 14px;
    padding: 1.25rem;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.notice-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}
.notice-title {
    font-size: 13px;
    font-weight: 600;
    color: #1e1e2e;
    display: flex;
    align-items: center;
    gap: 7px;
}
.notice-title i { color: #854F0B; }
.notice-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #f5f5f5;
}
.notice-row:last-child { border-bottom: none; padding-bottom: 0; }
.notice-name { font-size: 13px; font-weight: 600; color: #1e1e2e; }
.notice-empty { font-size: 13px; color: #888; padding: 6px 0; }
.notice-empty i { margin-right: 6px; }

.badge-status {
    font-size: 11px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    white-space: nowrap;
}
.badge-warn   { background: #FAEEDA; color: #854F0B; }
.badge-danger { background: #FCEBEB; color: #A32D2D; }
.badge-ok     { background: #EAF3DE; color: #3B6D11; }

.section-label {
    font-size: 11px;
    font-weight: 600;
    color: #888;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    margin-top: 1.5rem;
}

.menu-card {
    background: #fff;
    border: 1px solid #f0f0f0;
    border-radius: 14px;
    padding: 1.25rem;
    cursor: pointer;
    transition: border-color 0.15s, transform 0.15s, box-shadow 0.15s;
    display: block;
}
.menu-card:hover {
    border-color: #c5caff;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(59,79,216,0.08) !important;
    text-decoration: none;
}
.menu-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}
.menu-icon--purple { background: #EEEDFE; color: #534AB7; }
.menu-icon--teal   { background: #E1F5EE; color: #0F6E56; }
.menu-title { font-size: 15px; font-weight: 600; color: #1e1e2e; margin-bottom: 4px; }
.menu-desc  { font-size: 13px; color: #888; line-height: 1.5; margin-bottom: 10px; }
.menu-cta   { font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 5px; }
.menu-cta--purple { color: #534AB7; }
.menu-cta--teal   { color: #0F6E56; }
</style>
@endsection