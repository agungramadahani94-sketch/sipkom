@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Daftar Alat</h1>
        </div>

        <div class="section-body">
            <div class="row">

                @forelse($alat as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-0">

                        <div style="height:240px; overflow:hidden; border-top-left-radius:10px; border-top-right-radius:10px;">
                            @if($item->gambar && file_exists(public_path('storage/'.$item->gambar)))
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     style="width:100%; height:240px; object-fit:cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}"
                                     style="width:100%; height:240px; object-fit:cover;">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column">

                            <h5 class="text-primary font-weight-bold mb-1">
                                {{ $item->nama_alat }}
                            </h5>

                            <p class="mb-2 text-muted small">
                                {{ ucfirst($item->kategori) }}
                            </p>

                            <div class="mb-3">
                                <small class="font-weight-bold text-muted d-block mb-1">
                                    Stok Tersedia:
                                </small>
                                <span class="badge badge-info px-2 py-1">
                                    {{ $item->stok }} unit
                                </span>
                                <span class="badge badge-secondary px-2 py-1 ml-2">
                                    Kondisi: {{ ucfirst($item->kondisi) }}
                                </span>
                            </div>

                            <div class="mt-auto">
                                @if($item->stok > 0)
                                    <a href="{{ route('user.pinjam', $item->id_alat) }}"
                                       class="btn btn-primary w-100">
                                        Pinjam ({{ $item->stok }} tersedia)
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        Tidak Ada yang Tersedia
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

                @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada alat.</p>
                </div>
                @endforelse

            </div>
        </div>

    </section>
</div>

<style>
.card img {
    transition: 0.3s ease;
}
.card:hover img {
    transform: scale(1.05);
}
.card {
    border-radius: 10px;
}
</style>

@endsection