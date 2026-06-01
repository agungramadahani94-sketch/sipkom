@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        {{-- HEADER --}}
        <div class="section-header shadow-sm">
            <h1>Form Peminjaman</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-lg border-0">
                <div class="card-body">

                    {{-- ALERT --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('user.pinjam.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="alat_id" value="{{ $alat->id_alat }}">

                        <div class="row">

                            {{-- NAMA ALAT --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Nama Alat</label>
                                <input type="text" class="form-control"
                                       value="{{ $alat->nama_alat }}" readonly>
                            </div>

                            {{-- STOK --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Stok Tersedia</label>
                                <input type="text" class="form-control"
                                       value="{{ $alat->stok }} unit tersedia" readonly>
                            </div>

                            {{-- JUMLAH PINJAM --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Jumlah Pinjam</label>
                                <input type="number"
                                       name="jumlah"
                                       id="jumlah"
                                       class="form-control"
                                       value="{{ old('jumlah', 1) }}"
                                       min="1"
                                       max="{{ $alat->stok }}"
                                       required>
                                <small class="text-muted">
                                    Maksimal {{ $alat->stok }} unit
                                </small>
                            </div>

                            {{-- TANGGAL PINJAM --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Tanggal Pinjam</label>
                                <input type="date"
                                       name="tanggal_pinjam"
                                       id="tglPinjam"
                                       class="form-control"
                                       value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                       min="{{ date('Y-m-d') }}"
                                       required>
                            </div>

                            {{-- TANGGAL KEMBALI --}}
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold">Tanggal Kembali</label>
                                <input type="date"
                                       name="tanggal_kembali"
                                       id="tglKembali"
                                       class="form-control"
                                       value="{{ old('tanggal_kembali') }}"
                                       min="{{ date('Y-m-d') }}"
                                       required>
                            </div>

                        </div>

                        {{-- BUTTON --}}
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

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const tglPinjam  = document.getElementById('tglPinjam');
    const tglKembali = document.getElementById('tglKembali');
    const jumlah     = document.getElementById('jumlah');
    const maxStok    = {{ $alat->stok }};

    // VALIDASI TANGGAL
    tglPinjam.addEventListener('change', function () {
        tglKembali.min = this.value;

        if (tglKembali.value && tglKembali.value < this.value) {
            tglKembali.value = this.value;
        }
    });

    // VALIDASI JUMLAH
    jumlah.addEventListener('input', function () {
        if (this.value > maxStok) {
            alert('Jumlah melebihi stok!');
            this.value = maxStok;
        }

        if (this.value < 1) {
            this.value = 1;
        }
    });

});
</script>
@endsection