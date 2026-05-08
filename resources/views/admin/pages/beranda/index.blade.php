@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-body">

                {{-- WELCOME --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-white shadow-sm">
                            <div class="card-body text-center">
                                <h3 class="text-dark"><b>Selamat Datang di Aplikasi SIPALKOM</b></h3>
                                <p class="mb-0">
                                    Sistem peminjaman alat laboratorium komputer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STATISTIK --}}
                <div class="row mt-3">

                    {{-- USER --}}
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 shadow-sm">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total User</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalUser ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ALAT --}}
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 shadow-sm">
                            <div class="card-icon bg-info">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Alat</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalAlat ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PEMINJAMAN --}}
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 shadow-sm">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-hand-holding"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Peminjaman</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalPeminjaman ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PENGEMBALIAN --}}
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1 shadow-sm">
                            <div class="card-icon bg-success">
                                <i class="fas fa-undo"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pengembalian</h4>
                                </div>
                                <div class="card-body">
                                    {{ $totalPengembalian ?? 0 }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section>
    </div>
@endsection