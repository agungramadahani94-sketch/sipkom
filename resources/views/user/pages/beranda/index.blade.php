@extends('user.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">

                {{-- WELCOME --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="welcome-card">
                            <div>
                                <h4>Halo, <b>{{ auth()->user()->nama }}</b> 👋</h4>
                                <p>Selamat datang di <strong>SIPALKOM</strong>. Kelola peminjaman alat dengan mudah.</p>
                            </div>
                            <div class="welcome-badge d-none d-md-block">
                                SIPALKOM
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATISTIK --}}
                <div class="row mb-4">

                    @php
                        $stats = [
                            ['icon' => 'fa-box-open', 'label' => 'Sedang Dipinjam', 'value' => $totalDipinjam ?? 0, 'color' => 'blue', 'unit' => 'alat'],
                            ['icon' => 'fa-check-circle', 'label' => 'Selesai', 'value' => $totalKembali ?? 0, 'color' => 'green', 'unit' => 'kali'],
                            ['icon' => 'fa-exclamation-circle', 'label' => 'Jatuh Tempo', 'value' => $totalJatuhTempo ?? 0, 'color' => 'amber', 'unit' => 'alat'],
                            ['icon' => 'fa-hourglass-half', 'label' => 'Menunggu ACC', 'value' => $totalPending ?? 0, 'color' => 'coral', 'unit' => 'req'],
                        ];
                    @endphp

                    @foreach($stats as $stat)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="stat-card">
                                <div class="stat-icon stat-icon--{{ $stat['color'] }}">
                                    <i class="fas {{ $stat['icon'] }}"></i>
                                </div>
                                <div>
                                    <div class="stat-label">{{ $stat['label'] }}</div>
                                    <div class="stat-value">
                                        {{ $stat['value'] }}
                                        <span class="stat-unit">{{ $stat['unit'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- PEMINJAMAN AKTIF --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="card-header-custom">
                                <div class="title">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Status Peminjaman Aktif
                                </div>
                                <small>{{ now()->translatedFormat('d M Y') }}</small>
                            </div>

                            @forelse($peminjamanAktif ?? [] as $item)
                                <div class="card-row">
                                    <div>
                                        <div class="name">{{ $item->alat->nama ?? '-' }}</div>
                                        <small>
                                            {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M') }}
                                            •
                                            {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M') }}
                                        </small>
                                    </div>

                                    @php
                                        $kembali = \Carbon\Carbon::parse($item->tgl_kembali);
                                    @endphp

                                    @if($kembali->isPast())
                                        <span class="badge-status danger">Terlambat</span>
                                    @elseif($kembali->diffInDays(now()) <= 2)
                                        <span class="badge-status warn">Segera</span>
                                    @else
                                        <span class="badge-status ok">Aman</span>
                                    @endif
                                </div>
                            @empty
                                <div class="empty-state">
                                    <i class="fas fa-check-circle"></i>
                                    Tidak ada peminjaman aktif
                                </div>
                            @endforelse

                        </div>
                    </div>
                </div>

                {{-- MENU --}}
                <div class="section-label">Akses Cepat</div>

                <div class="row mt-3">

                    <div class="col-md-6 mb-3">
                        <a href="{{ route('user.alat') }}" class="menu-card">
                            <div class="menu-icon purple">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div>
                                <div class="menu-title">Katalog Alat</div>
                                <div class="menu-desc">Cari alat laboratorium</div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 mb-3">
                        <a href="{{ route('user.peminjaman') }}" class="menu-card">
                            <div class="menu-icon teal">
                                <i class="fas fa-history"></i>
                            </div>
                            <div>
                                <div class="menu-title">Riwayat</div>
                                <div class="menu-desc">Cek status peminjaman</div>
                            </div>
                        </a>
                    </div>

                </div>

            </div>
        </section>
    </div>

    <style>
        /* WELCOME */
        .welcome-card {
            background: linear-gradient(135deg, #3B4FD8, #7C8CFF);
            color: #fff;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* STAT */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon--blue {
            background: #E6F1FB;
            color: #185FA5;
        }

        .stat-icon--green {
            background: #EAF3DE;
            color: #3B6D11;
        }

        .stat-icon--amber {
            background: #FAEEDA;
            color: #854F0B;
        }

        .stat-icon--coral {
            background: #FAECE7;
            color: #993C1D;
        }

        .stat-value {
            font-weight: 600;
            font-size: 20px;
        }

        /* CARD */
        .card-box {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .card-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .name {
            font-weight: 600;
        }

        /* BADGE */
        .badge-status {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
        }

        .badge-status.ok {
            background: #EAF3DE;
            color: #3B6D11;
        }

        .badge-status.warn {
            background: #FAEEDA;
            color: #854F0B;
        }

        .badge-status.danger {
            background: #FCEBEB;
            color: #A32D2D;
        }

        /* MENU */
        .menu-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: center;
            transition: .2s;
        }

        .menu-card:hover {
            transform: translateY(-3px);
        }

        .menu-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .purple {
            background: #EEEDFE;
            color: #534AB7;
        }

        .teal {
            background: #E1F5EE;
            color: #0F6E56;
        }

        .menu-title {
            font-weight: 600;
        }

        .menu-desc {
            font-size: 13px;
            color: #888;
        }

        .section-label {
            font-size: 12px;
            color: #888;
            font-weight: 600;
        }

        /* EMPTY */
        .empty-state {
            text-align: center;
            padding: 10px;
            color: #888;
        }
    </style>

@endsection