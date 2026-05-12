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
                    <div class="card shadow-sm h-100">

                        {{-- ✅ GAMBAR --}}
                        <div style="height:200px; overflow:hidden;">
                            @if($item->gambar && file_exists(public_path('storage/'.$item->gambar)))
                                <img src="{{ asset('storage/'.$item->gambar) }}"
                                     style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <img src="{{ asset('images/no-image.png') }}"
                                     style="width:100%; height:100%; object-fit:cover;">
                            @endif
                        </div>

                        {{-- BODY --}}
                        <div class="card-body d-flex flex-column">
                            <h5 class="text-primary">{{ $item->nama_alat }}</h5>

                            <p class="mb-1">Kategori: {{ $item->kategori }}</p>

                            <p class="mb-2">
                                Stok:
                                <b class="{{ $item->stok == 0 ? 'text-danger' : 'text-success' }}">
                                    {{ $item->stok }}
                                </b>
                            </p>

                            {{-- BUTTON --}}
                            <div class="mt-auto">
                                @if($item->stok > 0)
                                    <a href="{{ route('user.pinjam', $item->id_alat) }}"
                                       class="btn btn-primary w-100">
                                        Pinjam
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        Stok Habis
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
@endsection
