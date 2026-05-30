@extends('user.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header shadow-sm">
                <h1>Form Peminjaman</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body">

                        {{-- ALERT ERROR --}}
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

                        <form action="{{ route('user.pinjam.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="alat_id" value="{{ $alat->id_alat }}">

                            <div class="row">

                                {{-- NAMA ALAT --}}
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Nama Alat</label>
                                    <input type="text" class="form-control" value="{{ $alat->nama_alat }}" readonly>
                                </div>

                                {{-- STOK --}}
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Stok Tersedia</label>
                                    <input type="text" class="form-control" value="{{ $alat->stok }}" readonly>
                                </div>

                                {{-- TANGGAL PINJAM --}}
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold">Tanggal Pinjam</label>
                                    <input type="date"
                                           name="tanggal_pinjam"
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

{{-- Pastikan tanggal_kembali min selalu >= tanggal_pinjam --}}
<script>
    const tglPinjam  = document.querySelector('[name="tanggal_pinjam"]');
    const tglKembali = document.querySelector('[name="tanggal_kembali"]');

    tglPinjam.addEventListener('change', function () {
        tglKembali.min = this.value;
        if (tglKembali.value && tglKembali.value < this.value) {
            tglKembali.value = this.value;
        }
    });
</script>
@endsection