@extends('admin.layouts.app')

@section('content')
<div class="main-content">

<section class="section">

    <div class="section-header">
        <h1>Edit Alat Laboratorium</h1>
    </div>

    <div class="section-body">

        <div class="card shadow-sm">

            <div class="card-header">
                <h4>Form Edit Data</h4>
            </div>

            <div class="card-body">

                {{-- ALERT ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>
                    </div>
                @endif

                <form action="{{ route('alatlab.update', $alat->id_alat) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- KIRI --}}
                        <div class="col-md-8">

                            {{-- Nama --}}
                            <div class="form-group">
                                <label>Nama Alat</label>

                                <input type="text"
                                       name="nama_alat"
                                       class="form-control"
                                       value="{{ old('nama_alat', $alat->nama_alat) }}"
                                       required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label>Kategori</label>

                                <input type="text"
                                       name="kategori"
                                       class="form-control"
                                       value="{{ old('kategori', $alat->kategori) }}"
                                       required>
                            </div>

                            {{-- Kondisi --}}
                            <div class="form-group">
                                <label>Kondisi</label>

                                <select name="kondisi"
                                        class="form-control"
                                        required>

                                    <option value="">-- Pilih Kondisi --</option>

                                    <option value="baik"
                                        {{ $alat->kondisi == 'baik' ? 'selected' : '' }}>
                                        Baik
                                    </option>

                                    <option value="rusak"
                                        {{ $alat->kondisi == 'rusak' ? 'selected' : '' }}>
                                        Rusak
                                    </option>

                                    <option value="diperbaiki"
                                        {{ $alat->kondisi == 'diperbaiki' ? 'selected' : '' }}>
                                        Diperbaiki
                                    </option>

                                </select>
                            </div>

                            {{-- Stok --}}
                            <div class="form-group">
                                <label>Stok</label>

                                <input type="number"
                                       name="stok"
                                       class="form-control"
                                       value="{{ old('stok', $alat->stok) }}"
                                       required>
                            </div>

                        </div>

                        {{-- KANAN --}}
                        <div class="col-md-4 text-center">

                            <label class="font-weight-bold">
                                Gambar Alat
                            </label>

                            {{-- Preview --}}
                            <div class="mb-3">

                                @if ($alat->gambar)

                                    <img id="preview"
                                         src="{{ asset('storage/' . $alat->gambar) }}"
                                         class="img-fluid rounded shadow border"
                                         style="max-height: 220px; object-fit: cover;">

                                @else

                                    <img id="preview"
                                         src=""
                                         class="img-fluid rounded shadow border d-none"
                                         style="max-height: 220px; object-fit: cover;">

                                    <p class="text-muted mt-2">
                                        Tidak ada gambar
                                    </p>

                                @endif

                            </div>

                            {{-- Upload --}}
                            <input type="file"
                                   name="gambar"
                                   class="form-control"
                                   accept="image/*"
                                   onchange="previewImage(event)">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti gambar
                            </small>

                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="text-right mt-4">

                        <a href="{{ route('alatlab.index') }}"
                           class="btn btn-secondary">

                            Kembali
                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</section>
</div>

{{-- Preview Image --}}
<script>
    function previewImage(event) {

        const preview = document.getElementById('preview');

        preview.src = URL.createObjectURL(event.target.files[0]);

        preview.classList.remove('d-none');
    }
</script>

@endsection
``