@extends('admin.layouts.app')

@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
        <h1>Tambah Peminjaman</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h4>Form Peminjaman</h4>
                    </div>

                    <div class="card-body">

                        {{-- ERROR VALIDASI --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('peminjam.store') }}" method="POST">
                            @csrf

                            {{-- USER --}}
                            <div class="form-group">
                                <label>Nama User</label>
                                <select name="id_user" class="form-control" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ALAT --}}
                            <div class="form-group">
                                <label>Nama Alat</label>
                                <select name="id_alat" class="form-control" required>
                                    <option value="">-- Pilih Alat --</option>
                                    @foreach ($alats as $a)
                                        <option value="{{ $a->id_alat }}">
                                            {{ $a->nama_alat }} (Stok: {{ $a->stok }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- TGL PINJAM --}}
                            <div class="form-group">
                                <label>Tanggal Pinjam</label>
                                <input type="date" 
                                       name="tgl_pinjam" 
                                       class="form-control" 
                                       required>
                            </div>

                            {{-- TGL KEMBALI --}}
                            <div class="form-group">
                                <label>Tanggal Pengembalian</label>
                                <input type="date" 
                                       name="tgl_pengembalian" 
                                       class="form-control" 
                                       required>
                            </div>

                            <div class="form-group text-right">
                                <a href="{{ route('peminjam.index') }}" class="btn btn-secondary">
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
        </div>
</section>
</div>
@endsection