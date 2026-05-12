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
                    <div class="card shadow-sm h-100 d-flex flex-column">

                        {{-- GAMBAR FIX --}}
                        <div style="height: 200px; overflow: hidden;">
                            @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                     alt="{{ $item->nama_alat }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}"
                                     alt="No Image"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>

                        {{-- BODY --}}
                        <div class="card-body d-flex flex-column">
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

                            <div class="mt-auto"></div>
                        </div>

                        {{-- FOOTER --}}
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