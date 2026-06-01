@extends('user.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            {{-- HEADER --}}
            <div class="section-header">
                <h1>Daftar Alat</h1>
            </div>

            {{-- CONTENT --}}
            <div class="section-body">
                <div class="row">

                    @forelse($alat as $item)
                        <div class="col-md-4 mb-4">

                            <div class="card alat-card h-100 shadow-sm border-0">

                                {{-- GAMBAR --}}
                                <div class="alat-img">
                                    @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_alat }}"
                                            class="alat-img-content">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                                            class="alat-img-content img-empty">
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body d-flex flex-column">

                                    <h5 class="alat-title">
                                        {{ $item->nama_alat }}
                                    </h5>

                                    <p class="alat-kategori">
                                        {{ ucfirst($item->kategori) }}
                                    </p>

                                    {{-- INFO --}}
                                    <div class="mb-3">
                                        <small class="text-muted d-block mb-1">
                                            Stok Tersedia:
                                        </small>

                                        <span class="badge badge-info">
                                            {{ $item->stok }} unit
                                        </span>

                                        <span class="badge badge-secondary ml-1">
                                            Kondisi: {{ ucfirst($item->kondisi) }}
                                        </span>
                                    </div>

                                    {{-- BUTTON --}}
                                    <div class="mt-auto">
                                        @if($item->stok > 0)
                                            <a href="{{ route('user.pinjam', $item->id_alat) }}" class="btn btn-primary btn-block">
                                                Pinjam ({{ $item->stok }} tersedia)
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-block" disabled>
                                                Tidak tersedia
                                            </button>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    @empty

                        {{-- EMPTY STATE --}}
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada alat tersedia</p>
                        </div>

                    @endforelse

                </div>
            </div>

        </section>
    </div>

    {{-- STYLE --}}
    <style>
        /* CARD */
        .alat-card {
            border-radius: 12px;
            overflow: hidden;
            transition: 0.25s ease;
        }

        .alat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        /* IMAGE */
        .alat-img {
            height: 200px;
            background: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #eee;
        }

        .alat-img-content {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 16px;
            transition: 0.3s;
        }

        .alat-card:hover .alat-img-content {
            transform: scale(1.05);
        }

        .img-empty {
            opacity: 0.4;
        }

        /* TEXT */
        .alat-title {
            font-size: 16px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 4px;
        }

        .alat-kategori {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        /* BADGE */
        .badge {
            padding: 5px 8px;
            font-size: 12px;
        }
    </style>

@endsection