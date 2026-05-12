@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="section-body">

            {{-- WELCOME CARD --}}
            <div class="row">
                <div class="col-12">
                    <div class="card bg-white shadow-sm">
                        <div class="card-body">
                            <h4 class="text-dark">Halo, <b>{{ auth()->user()->nama }}</b> 👋</h4>
                            <p class="mb-0 text-muted">Selamat datang di sistem peminjaman alat laboratorium komputer SIPALKOM.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- INFO --}}
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-hand-holding"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sedang Dipinjam</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalDipinjam ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-statistic-1 shadow-sm">
                        <div class="card-icon bg-success">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sudah Dikembalikan</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalKembali ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SHORTCUT --}}
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('user.alat') }}" class="btn btn-primary mr-2">
                                <i class="fas fa-laptop"></i> Lihat Alat
                            </a>
                            <a href="{{ route('user.peminjaman') }}" class="btn btn-info">
                                <i class="fas fa-list"></i> Riwayat Peminjaman
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection