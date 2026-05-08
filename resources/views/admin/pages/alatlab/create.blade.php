@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">
                <h1>Tambah Alat Laboratorium</h1>
            </div>

            <div class="section-body">
                <div class="card shadow-sm">

                    <div class="card-header">
                        <h4>Form Tambah Data</h4>
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

                        <form action="{{ route('alatlab.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            {{-- Nama Alat --}}
                            <div class="form-group">
                                <label>Nama Alat</label>

                                <input type="text" name="nama_alat" class="form-control" value="{{ old('nama_alat') }}"
                                    required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label>Kategori</label>

                                <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}"
                                    required>
                            </div>

                            {{-- Kondisi --}}
                            <div class="form-group">
                                <label>Kondisi</label>

                                <select name="kondisi" class="form-control" required>

                                    <option value="">-- Pilih Kondisi --</option>

                                    <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                        Baik
                                    </option>

                                    <option value="rusak" {{ old('kondisi') == 'rusak' ? 'selected' : '' }}>
                                        Rusak
                                    </option>

                                    <option value="diperbaiki" {{ old('kondisi') == 'diperbaiki' ? 'selected' : '' }}>
                                        Diperbaiki
                                    </option>

                                </select>
                            </div>

                            {{-- Stok --}}
                            <div class="form-group">
                                <label>Stok</label>

                                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
                            </div>

                            {{-- Upload Gambar --}}
                            <div class="form-group">
                                <label>Gambar</label>

                                <input type="file" name="gambar" class="form-control" accept="image/*"
                                    onchange="previewImage(event)" required>


                            </div>



                            {{-- Tombol --}}
                            <div class="text-right mt-4">

                                <a href="{{ route('alatlab.index') }}" class="btn btn-secondary">

                                    Kembali
                                </a>

                                <button type="submit" class="btn btn-primary">

                                    Simpan
                                </button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </section>
    </div>



@endsection