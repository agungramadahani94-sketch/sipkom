@extends('user.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <!-- HEADER -->
            <div class="section-header shadow-sm">
                <h1>Form Peminjaman</h1>
            </div>

            <div class="section-body">

                <div class="card shadow-lg border-0">
                    <div class="card-body">

                        <!-- ALERT -->
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- FORM -->
                        <form action="{{ route('user.pinjam.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="alat_id" value="{{ $alat->id_alat }}">

                            <div class="row">

                                <!-- NAMA ALAT -->
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Nama Alat</label>
                                    <input type="text" class="form-control" value="{{ $alat->nama_alat }}" readonly>
                                </div>

                                <!-- STOK -->
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Stok Tersedia</label>
                                    <input type="text" class="form-control" value="{{ $alat->stok }}" readonly>
                                </div>

                                <!-- JUMLAH PINJAM -->
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Jumlah Pinjam</label>
                                    <input type="number" name="jumlah" class="form-control" min="1" max="{{ $alat->stok }}"
                                        required>
                                </div>

                                <!-- TANGGAL PINJAM -->
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>

                                <!-- TANGGAL KEMBALI -->
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Tanggal Kembali</label>
                                    <input type="date" name="tanggal_kembali" class="form-control" required>
                                </div>



                            </div>

                            <!-- BUTTON -->
                            <div class="text-right mt-4">
                                <a href="{{ route('user.alat') }}" class="btn btn-secondary px-4">
                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-primary px-4">
                                    Pinjam Sekarang
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection