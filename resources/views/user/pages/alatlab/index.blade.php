@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Alat Laboratorium</h1>
        </div>

        <div class="section-body">
            <div class="row">
                @forelse($alat as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">

                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                 class="card-img-top"
                                 alt="{{ $item->nama_alat }}"
                                 style="height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center"
                                 style="height: 180px;">
                                <i class="fas fa-laptop fa-3x text-muted"></i>
                            </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_alat }}</h5>
                            <p class="card-text text-muted mb-1">
                                <i class="fas fa-tag"></i> {{ $item->kategori }}
                            </p>
                            <p class="card-text mb-1">
                                Kondisi:
                                @if($item->kondisi == 'baik')
                                    <span class="badge badge-success">Baik</span>
                                @elseif($item->kondisi == 'rusak')
                                    <span class="badge badge-danger">Rusak</span>
                                @else
                                    <span class="badge badge-warning">Diperbaiki</span>
                                @endif
                            </p>
                            <p class="card-text">
                                Stok: <b>{{ $item->stok }}</b>
                            </p>
                        </div>

                        <div class="card-footer bg-white">
                            <form action="{{ route('user.pinjam') }}" method="POST">
                                @csrf
                                <input type="hidden" name="alat_id" value="{{ $item->id_alat }}">
                                <button type="submit"
                                        class="btn btn-primary btn-block"
                                        {{ $item->stok == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-hand-holding"></i>
                                    {{ $item->stok == 0 ? 'Stok Habis' : 'Pinjam' }}
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada alat laboratorium tersedia.
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </section>
</div>
@endsection